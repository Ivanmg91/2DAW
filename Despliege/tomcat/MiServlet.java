    import java.io.*;
    import javax.servlet.*;
    import javax.servlet.http.*;
    import java.sql.*;


    public class MiServlet extends HttpServlet
    {
        public void doPost(HttpServletRequest peticion, HttpServletResponse respuesta)
        throws ServletException, IOException
        {
            respuesta.setContentType("text/html");
            PrintWriter salida = respuesta.getWriter();

            // create variables to store the parameters
            String email = peticion.getParameter("email");
            String contrasena = peticion.getParameter("contrasena");

            // draw table
            String titulo = "Conexión JDBC a MySQL";
            salida.println ("<TITLE>"+titulo+"</TITLE>\n");
            salida.println ("<BODY BGCOLOR=\"#FDF5E6\">\n");
            salida.println ("<H1 ALIGN=CENTER>"+titulo+"</H1>\n\n");
            try
            {

                //Class.forName("org.mariadb.jdbc.Driver");
                String SourceURL = "jdbc:mysql://localhost/bdprueba?allowPublicKeyRetrieval=true&useSSL=false";
                String user = "alumno";
                String password = "mipassword";

                ResultSet misresultados;

                // manage connection
                Connection miconexion;
                miconexion = DriverManager.getConnection(SourceURL, user, password);

                // String query = "INSERT INTO users (email, password) VALUES (?, ?)";
                // PreparedStatement stmtInsert = miconexion.prepareStatement(query);
                // stmtInsert.setString(1, email);
                // stmtInsert.setString(2, contrasena);
                // misresultados = stmtInsert.executeQuery();

                String query = "SELECT * FROM users";
                PreparedStatement stmtSelect = miconexion.prepareStatement(query);

                misresultados = stmtSelect.executeQuery();

                // print results
                while (misresultados.next()) {

                    String emailbd = misresultados.getString("email");
                    String passwordbd = misresultados.getString("password");

                    if (email.equals(emailbd) && password.equals(passwordbd)) {
                        salida.println("Inicio de sesión exitoso");
                        return;
                    }

                }

                salida.println("Inicio de sesión erróneo"); // Si el ciclo termina sin encontrar coincidencias
                salida.println("</TABLE></BODY></HTML>");
                miconexion.close();
            } catch (SQLException sqle) {
                salida.println(sqle);
                salida.println("</BODY></HTML>");
            } finally {
                // Show the web another time. Infinite loop.
                salida.println("<html>");
                salida.println("<body>");
                salida.println("<form action='servlet' method='post'>");
                salida.println("email: <input type='text' name='email'><br>");
                salida.println("constrasena: <input type='text' name='contrasena'><br>");
                salida.println("<input type='submit' value='Buscar'>");
                salida.println("</form>");
                salida.println("</body>");
                salida.println("</html>");
            }
        }
    }
