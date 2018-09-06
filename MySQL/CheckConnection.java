public class CheckConnection
{
    public static void main(String[] args)
    {
        String url = "jdbc:mysql://localhost:3306/gardinProject";
        String user = "viktorpi";
        String password = "Preacher-123";
        
        System.out.println("Connection database...");
    
        try(Connection connection = DriverManager.getConnection(url, username, password))
        {
            System.out.println("Connected");
        }
        catch (SQLException e)
        {
            throw new IllegalStateException("Cannot connect", e);
        }
    }
    
}
