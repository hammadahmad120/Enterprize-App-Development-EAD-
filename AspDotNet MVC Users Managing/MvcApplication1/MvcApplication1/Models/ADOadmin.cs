using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace MvcApplication1.Models
{
    public class ADOadmin
    {

        public Boolean validateAdmin(String log, String pass)
        {

            String sqlConn = @"Data Source=.\SQLEXPRESS2012; Initial Catalog=Assignment4; User id=sa; Password=120";
            using (SqlConnection conn = new SqlConnection(sqlConn))
            {
                conn.Open();
                String query = String.Format(@"select * from dbo.Admin where Login='{0}' and Password='{1}'", log, pass);
                SqlCommand comm = new SqlCommand(query, conn);
                SqlDataReader rd = comm.ExecuteReader();
                if (rd.HasRows == true)
                    return true;
                else
                    return false;

            }
        }

    }
}