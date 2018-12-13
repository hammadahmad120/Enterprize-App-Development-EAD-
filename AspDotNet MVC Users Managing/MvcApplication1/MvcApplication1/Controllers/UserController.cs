using Assignment4;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Mail;
using System.Web;
using System.Web.Mvc;

namespace MvcApplication1.Controllers
{
    public class UserController : Controller
    {
        //
        // GET: /User/

        public ActionResult Index()
        {
            return View("MainPage");
        }
        public ActionResult AddUser()
        {
            return View();
        }

        public ActionResult Logout()
        {
            Session.Clear();
            ModelState.Clear();
            return View("MainPage");
        }
        public ActionResult Login()
        {
            return View();
        }
        public ActionResult Home2()
        {
            var obj = new User();
            var Dobj = new ADOusers();
            String str = Session["login"].ToString();
            obj = Dobj.getUser(str);
            Session["id"] = obj.id;
            ViewData["User"] = obj;
            return View("Home");
        }

        public ActionResult LoginUser()
        {
            if(Request["txtlogin"]==null||Request["txtpassword"]==null)
            {
                ViewData["Err"] = "Both login and password mandatory";
                return View("Login");
            }

            var log = Request["txtlogin"];
            var pass = Request["txtpassword"];
            var obj = new User();
            var Dobj = new ADOusers();
            if (Dobj.UserLogin(log, pass))
            {
                obj = Dobj.getUser(log);
                Session["login"] = log;
                ViewData["User"] = obj;
                ViewData["Err"] = null;
                return View("Home");
            }
            else
            {
                ViewData["Err"] = "Invalid login or password";
                return View("Login");
            }
        }

        public ActionResult ConfirmCode()
        {
            var code = Request["txtcode"];
            String Mcode = Session["code"].ToString();
            if (code == Mcode)
            {
                ViewData["ErrorMsg1"] = null;
                return View("NewPassword");
            }
            else
            {
                ViewData["ErrorMsg2"] = "Wrong Code";
                return View("Reset");
            }
        }

        public ActionResult UpdatePassword()
        {
            var newPass = Request["txtpassword"];
            var log = (Session["login"]).ToString();
            var obj = new ADOusers();
            var uobj = obj.getUser(log);
            obj.updatePassword(log, newPass);
            ViewData["User"] = uobj;
            return View("Home");
           
        }
        public ActionResult Reset()
        {
            String str="12345";
            
            String toEmail = Request["txtemail"];
            var obj = new User();
            var Dobj = new ADOusers();
            obj = Dobj.getUserbyEmail(toEmail);
            if (obj != null)
            {
                Session["code"] = str;
                Session["login"] = obj.Login;
                try
                {


                    String fromEmail = "hammad.shahid120@gmail.com";
                    String fromPass = "h120s120";
                    String fromDisplayName = "123456789";
                    MailAddress fromAddress = new MailAddress(fromEmail, fromDisplayName);
                    MailAddress toAddress = new MailAddress(toEmail);

                    System.Net.Mail.SmtpClient smtp = new System.Net.Mail.SmtpClient
                    {
                        Host = "smtp.gmail.com",
                        Port = 587,
                        EnableSsl = true,
                        DeliveryMethod = System.Net.Mail.SmtpDeliveryMethod.Network,
                        UseDefaultCredentials = false,
                        Credentials = new NetworkCredential(fromAddress.Address, fromPass)


                    };
                    using (var message = new MailMessage(fromAddress, toAddress)
                    {
                        Subject = "Verification",
                        Body = str
                    })
                    {
                        smtp.Send(message);
                    }
                    ViewData["ErrorMsg1"] = null;
                }
                catch (Exception ex)
                {

                }

                return View();
            }
            else
            {
                ViewData["ErrorMsg1"] = "Wrong Email";
                return View("Login");
            }
        }
       

        public ActionResult Home()
        {
            var obj = new User();
            obj.Name = Request["txtname"];
            obj.Login = Request["txtlogin"];
            obj.Password = Request["txtpassword"];
            obj.email = Request["txtemail"];
            obj.Gender = Request["txtgender"];
            obj.Address = Request["txtaddress"];
            obj.age = Convert.ToInt32(Request["txtage"]);
            obj.NIC = Request["txtnic"];
            obj.DOB = Request["txtdob"];
            if (obj.Name == null || obj.Login == null || obj.Password == null || obj.email == null || obj.Gender == null || obj.Address == null || obj.age == null || obj.NIC == null || obj.DOB == null)
            {
                ViewData["ErrorMsg"] = "All Values Are Mandatory except checkboxes and image";
                return View("AddUser");
            }
            if (Request["txtcricket"] != null)
                obj.Cricket = true;
            else
                obj.Cricket = false;
            if (Request["txthockey"] != null)
                obj.Hockey = true;
            else
                obj.Hockey = false;
            if (Request["txtchess"] != null)
                obj.Chess = true;
            else
                obj.Chess = false;
            var uniquename = "";
            if (Request.Files["image"] != null)
            {
               
                var file = Request.Files["image"];
                if (file.FileName != "")
                {
                    var ext = System.IO.Path.GetExtension(file.FileName);
                    uniquename = Guid.NewGuid().ToString() + ext;
                    var rootPath = Server.MapPath("~/UploadedFiles");
                    var fileSavePath = System.IO.Path.Combine(rootPath, uniquename);
                    file.SaveAs(fileSavePath);
                }
            }
            obj.ImageName = uniquename;
            obj.CreatedOn = (DateTime.Now).ToString();
            var obj1=new ADOusers();
            if (obj1.validateUser(obj.Login, obj.email))
            {
                
                ViewData["ErrorMsg"] = "Username or Email already exist";
                return View("AddUser");
            }
            else
            {
                obj1.add_User(obj);
                Session["login"] = obj.Login;
                ViewData["ErrorMsg"] = null;
                ViewData["User"] = obj;
                return View("Home");
            }
        }

        public ActionResult EditUser()
        {
            var obj = new User();
            var Dobj = new ADOusers();
            String str = Session["login"].ToString();
            obj = Dobj.getUser(str);
            Session["id"] = obj.id;
            return View(obj);
        }

        public ActionResult Update()
        {
            var obj = new User();
            int Id = Convert.ToInt32(Session["id"]);
            obj.id = Id;
            obj.Name = Request["txtname"];
            obj.Login = Request["txtlogin"];
            obj.Password = Request["txtpassword"];
            obj.email = Request["txtemail"];
            obj.Gender = Request["txtgender"];
            obj.Address = Request["txtaddress"];
            obj.age = Convert.ToInt32(Request["txtage"]);
            obj.NIC = Request["txtnic"];
            obj.DOB = Request["txtdob"];
            if (Request["txtcricket"] != null)
                obj.Cricket = true;
            else
                obj.Cricket = false;
            if (Request["txthockey"] != null)
                obj.Hockey = true;
            else
                obj.Hockey = false;
            if (Request["txtchess"] != null)
                obj.Chess = true;
            else
                obj.Chess = false;

            var uniquename = "";
            var file1=Request["myImage"];
            if (Request.Files["mymage"] != null)
            {

                var file = Request.Files["myImage"];
                if (file.FileName != "")
                {
                    var ext = System.IO.Path.GetExtension(file.FileName);
                    uniquename = Guid.NewGuid().ToString() + ext;
                    var rootPath = Server.MapPath("~/UploadedFiles");
                    var fileSavePath = System.IO.Path.Combine(rootPath, uniquename);
                    file.SaveAs(fileSavePath);
                }
            }
            
            obj.ImageName = uniquename;

            obj.CreatedOn = (DateTime.Now).ToString();
            var obj1 = new ADOusers();
            if (obj1.updateUser(obj))
            {
                ViewData["User"] = obj;
                if (Session["admin"] != null)
                    return Redirect("/Admin/HomeAdmin2");
                return View("Home");
            }
            else
            {
                return View("EditUser");
            }
        }


    }
}
