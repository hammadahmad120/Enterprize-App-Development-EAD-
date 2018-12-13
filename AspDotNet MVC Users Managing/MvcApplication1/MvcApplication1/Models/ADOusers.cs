using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.SqlClient;
using System.Data;
namespace Assignment4
{
    class ADOusers
    {
        public Boolean add_User(User obj){

            Boolean chk = validateUser(obj.Login, obj.email);
            if (chk == true)
            {
                return false;
            }


            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"Insert into  dbo.Users values('{0}','{1}','{2}','{3}','{4}','{5}','{6}','{7}','{8}','{9}','{10}','{11}','{12}','{13}')" , obj.Name, obj.Login,obj.Password,obj.email,obj.Gender,obj.Address,obj.age,obj.NIC,obj.DOB,obj.Cricket,obj.Hockey,obj.Chess,obj.ImageName,obj.CreatedOn);
                SqlCommand comm = new SqlCommand(query, conn);
                comm.ExecuteNonQuery();

            }
            return true;
        }

        public Boolean updateUser(User obj)
        {
            Boolean chk = validateUpdatedUser(obj.Login, obj.email,obj.id);
            if (chk == true)
            {
                return false;
            }

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"Update dbo.Users set Name='{0}',Login='{1}',Email='{2}',Gender='{3}',Address='{4}',Age='{5}',NIC='{6}',DOB='{7}',IsCricket='{8}',Hockey='{9}',Chess='{10}',ImageName='{11}',CreatedOn='{12}',Password='{13}' where UserID={14}", obj.Name, obj.Login, obj.email, obj.Gender, obj.Address, obj.age, obj.NIC, obj.DOB, obj.Cricket, obj.Hockey, obj.Chess, obj.ImageName, obj.CreatedOn,obj.Password,obj.id);
                SqlCommand comm = new SqlCommand(query, conn);
                comm.ExecuteNonQuery();

            }

            return true;
        }

        public Boolean updatePassword(String log,String pass)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"Update dbo.Users set Password='{0}' where Login='{1}'", pass,log);
                SqlCommand comm = new SqlCommand(query, conn);
                comm.ExecuteNonQuery();

            }

            return true;
        }

        public Boolean validateUser(String log, String email)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users where Login='{0}' OR Email='{1}'" ,log,email);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
                if (rd.HasRows == true)
                    return true;
                else
                    return false; 

            }
        }

        public Boolean UserLogin(String log, String pass)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users where Login='{0}' and Password='{1}'", log, pass);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
                if (rd.HasRows == true)
                    return true;
                else
                    return false;

            }
        }


        public Boolean validateUpdatedUser(String log, String email,int id)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users where (Login='{0}' OR Email='{1}') and UserID<>{2}", log, email,id);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
                if (rd.HasRows == true)
                    return true;
                else
                    return false;

            }
        }


        public User getUser(String log)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users where Login='{0}'", log);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
               
                    rd.Read();
                    User obj = new User();
                    obj.id = rd.GetInt32(0);
                    obj.Name = rd.GetString(1);
                    obj.Login = rd.GetString(2);
                    obj.Password = rd.GetString(3);
                    obj.email = rd.GetString(4);
                    obj.Gender = rd.GetString(5);
                    obj.Address = rd.GetString(6);
                    obj.age = rd.GetInt32(7);
                    obj.NIC = rd.GetString(8);
                    obj.DOB = rd.GetDateTime(9).ToString("yyyy-MM-dd");
                    obj.Cricket = rd.GetBoolean(10);
                    obj.Hockey = rd.GetBoolean(11);
                    obj.Chess = rd.GetBoolean(12);
                    obj.ImageName = rd.GetString(13);
                    obj.CreatedOn = rd.GetDateTime(14).ToString();
                    return obj;

            }
        }

        public User getUserbyEmail(String email)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users where Email='{0}'", email);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
                if (rd.HasRows == true)
                {
                    rd.Read();
                    User obj = new User();
                    obj.id = rd.GetInt32(0);
                    obj.Name = rd.GetString(1);
                    obj.Login = rd.GetString(2);
                    obj.Password = rd.GetString(3);
                    obj.email = rd.GetString(4);
                    obj.Gender = rd.GetString(5);
                    obj.Address = rd.GetString(6);
                    obj.age = rd.GetInt32(7);
                    obj.NIC = rd.GetString(8);
                    obj.DOB = rd.GetDateTime(9).ToString();
                    obj.Cricket = rd.GetBoolean(10);
                    obj.Hockey = rd.GetBoolean(11);
                    obj.Chess = rd.GetBoolean(12);
                    obj.ImageName = rd.GetString(13);
                    obj.CreatedOn = rd.GetDateTime(14).ToString();
                    return obj;
                }
                else
                    return null;

            }
        }

        public User getUserbyId(int id)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users where UserID='{0}'", id);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
                if (rd.HasRows == true)
                {
                    rd.Read();
                    User obj = new User();
                    obj.id = rd.GetInt32(0);
                    obj.Name = rd.GetString(1);
                    obj.Login = rd.GetString(2);
                    obj.Password = rd.GetString(3);
                    obj.email = rd.GetString(4);
                    obj.Gender = rd.GetString(5);
                    obj.Address = rd.GetString(6);
                    obj.age = rd.GetInt32(7);
                    obj.NIC = rd.GetString(8);
                    obj.DOB = rd.GetDateTime(9).ToString();
                    obj.Cricket = rd.GetBoolean(10);
                    obj.Hockey = rd.GetBoolean(11);
                    obj.Chess = rd.GetBoolean(12);
                    obj.ImageName = rd.GetString(13);
                    obj.CreatedOn = rd.GetDateTime(14).ToString();
                    return obj;
                }
                else
                    return null;

            }
        }

        public DataTable getAllUsers()
        {
           // List<User> lst = new List<User>();
            DataTable dt = new DataTable("Users");
            DataColumn dc=new DataColumn("UserID",typeof(System.Int32));
            dt.Columns.Add(dc);

            dc = new DataColumn("Name", typeof(System.String));
            dt.Columns.Add(dc);

            dc = new DataColumn("Login", typeof(System.String));
            dt.Columns.Add(dc);

            dc = new DataColumn("Address", typeof(System.String));
            dt.Columns.Add(dc);

            dc = new DataColumn("Age", typeof(System.Int32));
            dt.Columns.Add(dc);

            DataRow dr;
            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users");
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
               
                while (rd.Read() == true)
                {
                    dr = dt.NewRow();
                    dr["UserID"]= rd.GetInt32(0);
                    dr["Name"] = rd.GetString(1);
                    dr["Login"] = rd.GetString(2);
                    dr["Address"] = rd.GetString(5);
                    dr["Age"] = rd.GetInt32(6);

                    dt.Rows.Add(dr);


                }
            }
            return dt;
        }


        public List<User> getAllUsersList()
        {
            List<User> lst = new List<User>();
            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Users");
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();

                while (rd.Read() == true)
                {
                    User obj = new User();
                    obj.id = rd.GetInt32(0);
                    obj.Name = rd.GetString(1);
                    obj.Login = rd.GetString(2);
                    obj.Address = rd.GetString(6);
                    obj.age = rd.GetInt32(7);

                    lst.Add(obj);


                }
            }
            return lst;
        }

    }
}
