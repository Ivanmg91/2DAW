import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
import java.util.*; 

// Main Servlet for Customers
public class MiServlet extends HttpServlet {

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String action = request.getParameter("action");
        
        // Common HTML Header
        out.println("<html><head><title>Web Shop</title></head>");
        out.println("<body bgcolor=\"#FDF5E6\">");

        Connection myConnection = null;
        try {
            // Database Connection
            String sourceURL = "jdbc:mysql://localhost/bdprueba?allowPublicKeyRetrieval=true&useSSL=false";
            // Class.forName("com.mysql.cj.jdbc.Driver"); 
            myConnection = DriverManager.getConnection(sourceURL, "alumno", "mipassword");
            Statement stmt = myConnection.createStatement();

            // --- DATABASE SETUP ---
            stmt.executeUpdate("CREATE TABLE IF NOT EXISTS usuarios_proyecto (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE, password VARCHAR(50), role VARCHAR(20))");
            stmt.executeUpdate("CREATE TABLE IF NOT EXISTS compras_proyecto (id INT AUTO_INCREMENT PRIMARY KEY, tracking_number INT, customer_name VARCHAR(100), items_list TEXT, total_price FLOAT)");
            
            // Fix: No DROP TABLE to keep products safe
            stmt.executeUpdate("CREATE TABLE IF NOT EXISTS productos_proyecto (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), price FLOAT, image_url TEXT)");

            // Create Admin
            ResultSet rsCheck = stmt.executeQuery("SELECT count(*) FROM usuarios_proyecto WHERE username='admin'");
            rsCheck.next();
            if (rsCheck.getInt(1) == 0) stmt.executeUpdate("INSERT INTO usuarios_proyecto (username, password, role) VALUES ('admin', 'admin123', 'seller')");
            
            // Create Default Products
            rsCheck = stmt.executeQuery("SELECT count(*) FROM productos_proyecto");
            rsCheck.next();
            if (rsCheck.getInt(1) == 0) {
                stmt.executeUpdate("INSERT INTO productos_proyecto (name, price, image_url) VALUES ('Java T-Shirt', 15.50, 'https://upload.wikimedia.org/wikipedia/en/3/30/Java_programming_language_logo.svg')");
                stmt.executeUpdate("INSERT INTO productos_proyecto (name, price, image_url) VALUES ('Coffee Mug', 8.00, 'https://m.media-amazon.com/images/I/51rJjX+M+iL.jpg')");
                stmt.executeUpdate("INSERT INTO productos_proyecto (name, price, image_url) VALUES ('Keyboard', 45.00, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Computer_keyboard_Danish_layout.svg/1200px-Computer_keyboard_Danish_layout.svg.png')");
            }

            // ================= LOGIC START =================

            // --- 1. REGISTER ---
            if ("register".equals(action)) {
                try {
                    String user = request.getParameter("username");
                    String pass = request.getParameter("password");
                    String query = "INSERT INTO usuarios_proyecto (username, password, role) VALUES (?, ?, 'customer')";
                    PreparedStatement ps = myConnection.prepareStatement(query);
                    ps.setString(1, user);
                    ps.setString(2, pass);
                    ps.executeUpdate();
                    out.println("<h2 style='color:green' align='center'>Registration Successful!</h2>");
                    out.println("<div align='center'><a href='parametros.html'>Login now</a></div>");
                } catch (Exception e) {
                    out.println("<h3 style='color:red' align='center'>User already exists.</h3>");
                    out.println("<div align='center'><a href='registro.html'>Back</a></div>");
                }
            }
            
            // --- 2. LOGIN (Creates Session and Cookie) ---
            else if ("login_customer".equals(action)) {
                String user = request.getParameter("username");
                String pass = request.getParameter("password");
                String query = "SELECT * FROM usuarios_proyecto WHERE username=? AND password=? AND role='customer'";
                PreparedStatement ps = myConnection.prepareStatement(query);
                ps.setString(1, user);
                ps.setString(2, pass);
                ResultSet rs = ps.executeQuery();

                if (rs.next()) {
                    // Create session and Cookie
                    HttpSession session = request.getSession();
                    session.setAttribute("user_session", user);
                    
                    // Clear previous cart on new login
                    session.removeAttribute("cart_db_accumulated");
                    session.removeAttribute("cart_html_accumulated");
                    session.removeAttribute("cart_subtotal_accumulated");
                    session.removeAttribute("cart_units_accumulated");

                    Cookie userCookie = new Cookie("shop_user_id", user);
                    userCookie.setMaxAge(60*60*24*30); 
                    response.addCookie(userCookie);

                    out.println("<h1 align='center'>Welcome, " + user + "!</h1>");
                    out.println("<form action='servlet' method='post'>"); 
                    out.println("<input type='hidden' name='action' value='calculate_total'>");
                    
                    out.println("<table border='1' align='center' cellpadding='5'>");
                    out.println("<tr bgcolor='#FFAD00'><th>Image</th><th>Item</th><th>Price</th><th>Quantity</th></tr>");
                    
                    ResultSet rsProds = stmt.executeQuery("SELECT * FROM productos_proyecto");
                    while (rsProds.next()) {
                        String id = rsProds.getString("id");
                        String name = rsProds.getString("name");
                        float price = rsProds.getFloat("price");
                        String img = rsProds.getString("image_url");
                        if(img == null || img.isEmpty()) img = "https://via.placeholder.com/50";

                        out.println("<tr>");
                        out.println("<td><img src='" + img + "' width='60' height='60' style='object-fit:contain'></td>");
                        out.println("<td>" + name + "</td>");
                        out.println("<td>" + price + " €</td>");
                        out.println("<td>");
                        out.println("<select name='qty_" + id + "'>");
                        for(int i=0; i<=5; i++) out.println("<option value='"+i+"'>"+i+"</option>");
                        out.println("</select>");
                        out.println("<input type='hidden' name='price_" + id + "' value='" + price + "'>");
                        out.println("<input type='hidden' name='name_" + id + "' value='" + name + "'>");
                        out.println("</td></tr>");
                    }
                    out.println("</table>");
                    out.println("<br><div align='center'><input type='submit' value='Add to Cart / Purchase' style='font-size:16px; padding:10px;'></div>");
                    out.println("</form>");
                } else {
                    out.println("<h3 style='color:red' align='center'>Login Failed</h3>");
                    out.println("<div align='center'><a href='parametros.html'>Try Again</a></div>");
                }
            }

            // --- 3. CALCULATE TOTAL (ACCUMULATIVE CART LOGIC) ---
            else if ("calculate_total".equals(action)) {
                HttpSession session = request.getSession();

                // 1. Retrieve previous session data (if any)
                String prevDbList = (String) session.getAttribute("cart_db_accumulated");
                String prevHtmlList = (String) session.getAttribute("cart_html_accumulated");
                Float prevSubtotal = (Float) session.getAttribute("cart_subtotal_accumulated");
                Integer prevUnits = (Integer) session.getAttribute("cart_units_accumulated");

                // Initialize if empty
                if (prevDbList == null) prevDbList = "";
                if (prevHtmlList == null) prevHtmlList = "";
                if (prevSubtotal == null) prevSubtotal = 0.0f;
                if (prevUnits == null) prevUnits = 0;

                // 2. Process NEW items from form
                float currentBatchPrice = 0;
                int currentBatchUnits = 0;
                
                StringBuilder newHtmlItems = new StringBuilder();
                StringBuilder newDbItems = new StringBuilder();
                
                Enumeration<String> paramNames = request.getParameterNames();
                while(paramNames.hasMoreElements()) {
                    String paramName = paramNames.nextElement();
                    if(paramName.startsWith("qty_")) {
                        String id = paramName.substring(4); 
                        int qty = Integer.parseInt(request.getParameter(paramName));
                        
                        if (qty > 0) {
                            float price = Float.parseFloat(request.getParameter("price_" + id));
                            String name = request.getParameter("name_" + id);
                            
                            float lineTotal = price * qty;
                            currentBatchPrice += lineTotal;
                            currentBatchUnits += qty;
                            
                            // Formats
                            newHtmlItems.append("<li><b>").append(name).append("</b> x ").append(qty).append(" = ").append(lineTotal).append(" €</li>");
                            newDbItems.append(name).append(" (").append(qty).append("), ");
                        }
                    }
                }

                // 3. Accumulate (Old + New)
                float totalProductPrice = prevSubtotal + currentBatchPrice;
                int totalUnits = prevUnits + currentBatchUnits;
                String finalDbList = prevDbList + newDbItems.toString();
                String finalHtmlList = prevHtmlList + newHtmlItems.toString();

                if (totalUnits > 0) {
                    // Update Session with accumulated values
                    session.setAttribute("cart_db_accumulated", finalDbList);
                    session.setAttribute("cart_html_accumulated", finalHtmlList);
                    session.setAttribute("cart_subtotal_accumulated", totalProductPrice);
                    session.setAttribute("cart_units_accumulated", totalUnits);

                    // Calculate Shipping based on TOTAL units
                    float shippingCost = 2.0f + (1.0f * totalUnits);
                    float finalTotal = totalProductPrice + shippingCost;
                    
                    // Save final totals for Confirmation step
                    session.setAttribute("cart_final_total", finalTotal);

                    // Show Summary
                    out.println("<h1 align='center'>Shopping Cart Summary</h1>");
                    out.println("<div align='center' style='border:1px solid black; width:50%; margin:auto; padding:20px; background:white;'>");
                    
                    out.println("<h3>Items in Cart:</h3>");
                    out.println("<ul style='list-style-type:none; padding:0; text-align:left; display:inline-block;'>");
                    out.println(finalHtmlList); // Shows accumulated list
                    out.println("</ul>");
                    
                    out.println("<hr style='width:80%'>");
                    out.println("<p>Subtotal: " + totalProductPrice + " €</p>");
                    out.println("<p>Shipping (2€ + 1€/unit): " + shippingCost + " €</p>");
                    out.println("<p><i>(Total Units: " + totalUnits + ")</i></p>");
                    out.println("<hr style='border: 1px solid black;'>");
                    out.println("<h2>TOTAL: " + finalTotal + " €</h2>");
                    
                    // Button: Confirm
                    out.println("<form action='servlet' method='post'>");
                    out.println("<input type='hidden' name='action' value='confirm_purchase'>");
                    out.println("<input type='submit' value='CONFIRM PURCHASE' style='background:green; color:white; padding:10px; cursor:pointer;'>");
                    out.println("</form>");
                    
                    // Button: Back to Shop (Reuse login logic to reload shop)
                    out.println("<br>");
                    out.println("<form action='servlet' method='post'>");
                    out.println("<input type='hidden' name='action' value='login_customer'>");
                    // We need to pass credentials again or use session in login. 
                    // For simplicity, we assume session is active and login_customer can be called or we just link to Home.
                    out.println("<input type='hidden' name='username' value='" + session.getAttribute("user_session") + "'>");
                    out.println("<input type='hidden' name='password' value='(check_session)'>"); // A trick: modify Login to check session if password is distinct
                    out.println("<input type='submit' value='< Continue Shopping (Add more items)' style='background:#ddd; padding:5px;'>");
                    out.println("</form>");
                    
                    out.println("<br><a href='parametros.html'>Cancel and Logout</a>");
                    out.println("</div>");

                } else {
                    out.println("<h3 align='center'>Cart is empty.</h3>");
                    out.println("<div align='center'><a href='parametros.html'>Go Back</a></div>");
                }
            }

            // --- 4. CONFIRM PURCHASE ---
            else if ("confirm_purchase".equals(action)) {
                HttpSession session = request.getSession();
                String items = (String) session.getAttribute("cart_db_accumulated");
                Float total = (Float) session.getAttribute("cart_final_total");
                String user = (String) session.getAttribute("user_session");

                if (items != null && user != null) {
                    int tracking = 1000;
                    ResultSet rsTrack = stmt.executeQuery("SELECT MAX(tracking_number) FROM compras_proyecto");
                    if (rsTrack.next()) {
                        int last = rsTrack.getInt(1);
                        if(last > 0) tracking = last + 1;
                    }

                    String insert = "INSERT INTO compras_proyecto (tracking_number, customer_name, items_list, total_price) VALUES (?, ?, ?, ?)";
                    PreparedStatement ps = myConnection.prepareStatement(insert);
                    ps.setInt(1, tracking);
                    ps.setString(2, user);
                    ps.setString(3, items);
                    ps.setFloat(4, total);
                    ps.executeUpdate();

                    out.println("<h1 align='center' style='color:green'>Thank You!</h1>");
                    out.println("<div align='center' style='border:1px solid green; width:50%; margin:auto; padding:20px; background:white;'>");
                    out.println("<h3>Order Confirmed.</h3>");
                    out.println("<p>Your Tracking Number is: <b>" + tracking + "</b></p>");
                    out.println("<br><a href='parametros.html'>Back to Home</a>");
                    out.println("</div>");
                    
                    // Clear Session
                    session.removeAttribute("cart_db_accumulated");
                    session.removeAttribute("cart_html_accumulated");
                    session.removeAttribute("cart_subtotal_accumulated");
                    session.removeAttribute("cart_units_accumulated");
                    session.removeAttribute("cart_final_total");
                } else {
                    out.println("<h3 align='center'>Session Expired. Please login again.</h3>");
                    out.println("<div align='center'><a href='parametros.html'>Home</a></div>");
                }
            }

            // --- 5. HISTORY FROM COOKIE ---
            else if ("history_cookie".equals(action)) {
                String cookieUser = null;
                Cookie[] cookies = request.getCookies();
                if (cookies != null) {
                    for (Cookie c : cookies) {
                        if ("shop_user_id".equals(c.getName())) {
                            cookieUser = c.getValue();
                            break;
                        }
                    }
                }

                if (cookieUser != null) {
                    out.println("<h1 align='center'>History for " + cookieUser + "</h1>");
                    out.println("<p align='center'>(User detected via Cookie)</p>");
                    
                    String query = "SELECT * FROM compras_proyecto WHERE customer_name = ?";
                    PreparedStatement ps = myConnection.prepareStatement(query);
                    ps.setString(1, cookieUser);
                    ResultSet rs = ps.executeQuery();
                    
                    out.println("<table border='1' align='center' cellpadding='5'>");
                    out.println("<tr bgcolor='#FFAD00'><th>Tracking</th><th>Items</th><th>Total</th></tr>");
                    
                    boolean hasHistory = false;
                    while(rs.next()) {
                        hasHistory = true;
                        out.println("<tr>");
                        out.println("<td>" + rs.getInt("tracking_number") + "</td>");
                        out.println("<td>" + rs.getString("items_list") + "</td>");
                        out.println("<td>" + rs.getFloat("total_price") + " €</td>");
                        out.println("</tr>");
                    }
                    out.println("</table>");
                    if(!hasHistory) out.println("<p align='center'>No past purchases found.</p>");
                    
                    out.println("<br><div align='center'><a href='parametros.html'>Back</a></div>");
                } else {
                    out.println("<h3 align='center'>No user cookie found. Please login at least once.</h3>");
                    out.println("<div align='center'><a href='parametros.html'>Back</a></div>");
                }
            }
            
            myConnection.close();

        } catch (Exception e) {
            out.println("Error: " + e.toString());
            e.printStackTrace();
        } finally {
            out.println("</body></html>");
        }
    }
}