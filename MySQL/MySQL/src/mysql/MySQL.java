package mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

public class MySQL 
{
    private static String url = "jdbc:mysql://localhost:3306/gardinProject?useSSL=false";
    private static String user = "viktorpi";
    private static String password = "Preacher-123";
    
    public static void main(String[] args)
    {
        
        updateSensor("'humtemp'", 10);
    }
    
    public static void excecuteQuery(String query) throws SQLException
    {
        try(Connection con = DriverManager.getConnection(url, user, password);
                Statement st = con.createStatement();
                ResultSet rs = st.executeQuery(query))
        {
            if (rs.next())
            {
                System.out.println(rs.getString(1));
            }
        }
        catch (SQLException ex)
        {
            Logger lgr = Logger.getLogger(MySQL.class.getName());
            lgr.log(Level.SEVERE, ex.getMessage(), ex);
        }
    }
    
    public static void updateSensor(String name, int val)
    {
        String query = "SELECT * FROM sensor WHERE name = " + name;
        //Statement stmt = null;
        
        try(Connection con = DriverManager.getConnection(url, user, password))
        {
            //stmt = con.createStatement();
            Statement stmt = con.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);
            
            ResultSet rs = stmt.executeQuery(query);
            //System.out.println(rs.toString());
            
            if(rs.next())
            {
                rs.updateInt("value", val);
                rs.updateRow();
            }
            else
            {
                System.out.println("Du sutter");
            }
            

        } 
        catch (SQLException e)
        {
            Logger lgr = Logger.getLogger(MySQL.class.getName());
            lgr.log(Level.SEVERE, e.getMessage(), e);
        }
        /*finally
        {
            if (stmt != null)
            {
                stmt.close();
            }
        }*/
    }
    
}
