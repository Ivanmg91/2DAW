import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.WebServlet; 
import java.sql.*;

// Servlet for Sellers/Admins
@WebServlet(name = "SellerServlet", urlPatterns = {"/servlet_vendedor"})
public class MiServlet_vendedor extends HttpServlet {

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String action = request.getParameter("action");
        String userForm = request.getParameter("username");
        String passForm = request.getParameter("password");
        
        // Setup visual style
        out.println("<html><head><title>Seller Dashboard</title></head>");
        out.println("<body bgcolor=\"#E0E0E0\">"); // Grey background

        Connection myConnection = null;
        try {
            String sourceURL = "jdbc:mysql://localhost/bdprueba?allowPublicKeyRetrieval=true&useSSL=false";
            // Class.forName("com.mysql.cj.jdbc.Driver"); 
            myConnection = DriverManager.getConnection(sourceURL, "alumno", "mipassword");
            Statement stmt = myConnection.createStatement();

            // --- ACTION: ADD NEW PRODUCT ---
            if ("add_product".equals(action)) {
                String newName = request.getParameter("prod_name");
                String newPrice = request.getParameter("prod_price");
                String newImage = request.getParameter("prod_image");
                
                try {
                    String queryInsert = "INSERT INTO productos_proyecto (name, price, image_url) VALUES (?, ?, ?)";
                    PreparedStatement ps = myConnection.prepareStatement(queryInsert);
                    ps.setString(1, newName);
                    // Parse float to ensure DB compatibility
                    ps.setFloat(2, Float.parseFloat(newPrice));
                    ps.setString(3, newImage);
                    ps.executeUpdate();
                    out.println("<script>alert('Product Added Successfully!');</script>");
                } catch (Exception e) {
                     out.println("<script>alert('Error adding product: " + e.getMessage() + "');</script>");
                }
            }

            // --- CHECK AUTHORIZATION ---
            boolean isAuthorized = false;
            
            if ("login_seller".equals(action)) {
                 String query = "SELECT * FROM usuarios_proyecto WHERE username=? AND password=? AND role='seller'";
                 PreparedStatement ps = myConnection.prepareStatement(query);
                 ps.setString(1, userForm);
                 ps.setString(2, passForm);
                 if (ps.executeQuery().next()) isAuthorized = true;
            } else if ("add_product".equals(action)) {
                isAuthorized = true; // Stay logged in after adding product
            }

            if (isAuthorized) {
                out.println("<h1 align='center'>Seller Dashboard</h1>");
                
                // --- SECTION A: ADD PRODUCT FORM ---
                out.println("<div align='center' style='background:white; border:1px solid black; width:60%; margin:auto; padding:15px;'>");
                out.println("<h3>Add New Product to Shop</h3>");
                out.println("<form action='servlet_vendedor' method='post'>");
                out.println("<input type='hidden' name='action' value='add_product'>");
                out.println("Name: <input type='text' name='prod_name' required> ");
                out.println("Price (€): <input type='text' name='prod_price' required size='5'><br><br>");
                out.println("Image URL: <input type='text' name='prod_image' size='50' placeholder='http://...'><br><br>");
                out.println("<input type='submit' value='Upload Product'>");
                out.println("</form>");
                out.println("</div><br>");
                
                // --- SECTION B: SALES REPORT ---
                out.println("<h3 align='center'>Sales Report</h3>");
                ResultSet rsSales = stmt.executeQuery("SELECT * FROM compras_proyecto");
                
                out.println("<table border='1' align='center' cellpadding='5' bgcolor='white'>");
                out.println("<tr bgcolor='#FFAD00'><th>Tracking</th><th>Customer</th><th>Items</th><th>Total (€)</th></tr>");
                
                // Print sales
                boolean hasSales = false;
                while (rsSales.next()) {
                    hasSales = true;
                    out.println("<tr>");
                    out.println("<td>" + rsSales.getInt("tracking_number") + "</td>");
                    out.println("<td>" + rsSales.getString("customer_name") + "</td>");
                    out.println("<td>" + rsSales.getString("items_list") + "</td>");
                    out.println("<td>" + rsSales.getFloat("total_price") + "</td>");
                    out.println("</tr>");
                }
                out.println("</table>");
                if (!hasSales) out.println("<p align='center'>No sales yet.</p>");
                
                out.println("<br><div align='center'><a href='parametros.html'>Logout</a></div>");

            } else {
                out.println("<h3 style='color:red' align='center'>Access Denied</h3>");
                out.println("<div align='center'><a href='login_vendedor.html'>Try Again</a></div>");
            }

            myConnection.close();

        } catch (Exception e) {
            out.println("<h3 style='color:red'>Error: " + e.toString() + "</h3>");
            e.printStackTrace();
        } finally {
            out.println("</body></html>");
        }
    }
}