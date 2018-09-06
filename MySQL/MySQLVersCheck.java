import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

public class MySQLVersCheck
{
     public static void main(String[] args) {

        String url = "jdbc:mysql://localhost:3306/gardinProject?useSSL=false";
        String user = "viktorpi";
        String password = "Preacher-123";
        
        String query = "SELECT VERSION()";

        try (Connection con = DriverManager.getConnection(url, user, password);
            Statement st = con.createStatement();
            ResultSet rs = st.executeQuery(query)) {

            if (rs.next()) {
                
                System.out.println(rs.getString(1));
            }

        } catch (SQLException ex) {
            
            Logger lgr = Logger.getLogger(MySQLVersCheck.class.getName());
            lgr.log(Level.SEVERE, ex.getMessage(), ex);
        } 
    }
}
