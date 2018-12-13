using PMS.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Mail;
using System.Web;
using System.Web.Mvc;
using WebPrac.Security;

namespace WebPrac.Controllers
{
    public class UserController : Controller
    {
        [HttpGet]
        public ActionResult Login()
        {
            return View();
        }

        [HttpPost]
        public ActionResult Login(String login, String password)
        {
            if(login==""||password=="")
            {
                ViewBag.MSG = "Invalid Login/Password";
                ViewBag.Login = login;
                return View();
            }
            var obj = PMS.BAL.UserBO.ValidateUser(login, password);
            if (obj != null)
            {
                Session["user"] = obj;
                if (obj.IsAdmin == true)
                    return Redirect("~/Home/Admin");
                else
                    return Redirect("~/Home/NormalUser");
            }

            ViewBag.MSG = "Invalid Login/Password";
            ViewBag.Login = login;

            return View();
        }

        [HttpGet]
        public ActionResult Register()
        {
            var dto = new UserDTO();
            return View(dto);
        }
        public ActionResult Profile(int id)
        {
            var obj = PMS.BAL.UserBO.GetUserById(id);
            return View(obj);
        }
        public ActionResult EditUser()
        {
            int cid=SessionManager.User.UserID;
            var obj = PMS.BAL.UserBO.GetUserById(cid);
            return View("Register",obj);
        }
        public ActionResult ChangePassword()
        {
            int cid = SessionManager.User.UserID;
            var obj = PMS.BAL.UserBO.GetUserById(cid);
            return View(obj);
        }

        public ActionResult UpdatePass()
        {
            var obj = new UserDTO();
            obj.UserID = Convert.ToInt32(Request["UserID"]);
            obj.Password = Request["txtpassword"];
            
            var rslt=PMS.BAL.UserBO.UpdatePassword(obj);
            TempData["tmsg"] = "Password Updated";
               return Redirect("Login");
            
        }

        [HttpPost]
        public ActionResult Save()
        {
            var obj = new UserDTO();
            obj.UserID = Convert.ToInt32( Request["UserID"]);
            obj.PictureName = Request["PictureName"];

            obj.Name = Request["txtname"];
            obj.Login = Request["txtlogin"];
            obj.Password = Request["txtpassword"];
            obj.Email = Request["txtemail"];
            obj.IsAdmin = false;
            obj.IsActive = true;
            ViewData["name"] = obj.Name;
            ViewData["login"] = obj.Login;
            if (obj.Name == null || obj.Login == null || obj.Password == null)
            {
                ViewData["ErrorMsg"] = "All Values Are Mandatory except image";
                return View("Register",obj);
            }
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
                    obj.PictureName = uniquename;
                }
            }
          
             var obj1 = PMS.BAL.UserBO.ValidateLogin(obj.Login);
            if (obj1!=null)
            {

                ViewData["ErrorMsg"] = "Username already exist";
                return View("Register",obj);
            }
            else
                PMS.BAL.UserBO.Save(obj);
            if (SessionManager.IsValidUser)
            {
                if (SessionManager.User.IsAdmin)
                return Redirect("~/Home/Admin");
                else
                    return Redirect("~/Home/NormalUser");
        }
            
            TempData["tmsg"] = "Account Created";
            return Redirect("Login");
        }
        [HttpPost]
        public ActionResult ConfirmCode()
        {
            var code = Request["txtcode"];
            String Mcode = Session["code"].ToString();
            int myId = Convert.ToInt32( Session["uid"]);
            if (code == Mcode)
            {
                ViewData["ErrorMsg1"] = null;
                var obj = PMS.BAL.UserBO.GetUserById(myId);
                return View("ChangePassword",obj);
            }
            else
            {
                ViewData["ErrorMsg2"] = "Wrong Code";
                return View("Reset");
            }
        }
        [HttpPost]
        public ActionResult Reset()
        {
            String str = "12345";

            String toEmail = Request["txtemail"];
            
            if ( toEmail == "")
            {
                ViewBag.MSG = "Invalid or email";
                //ViewBag.Login = log;
                return View("Login");
            }
            var obj1 = PMS.BAL.UserBO.ValidateLogin(toEmail);

            if(obj1!=null){

                Session["code"] = str;
                Session["uid"]=obj1.UserID;
                try
                {
                    String fromEmail = "hammad.shahid120@gmail.com";
                    String fromPass = "h120s120";
                    String fromDisplayName = "23456789";
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
                ViewBag.MSG = "Invalid Email";
                return View("Login"); 
            }
            
        }
       


        [HttpGet]
        public ActionResult Logout()
        {
            SessionManager.ClearSession();
            return RedirectToAction("Login");
        }


        [HttpGet]
        public ActionResult Login2()
        {
            return View();
        }

        [HttpPost]
        public JsonResult ValidateUser(String login, String password)
        {

            Object data = null;

            try
            {
                var url = "";
                var flag = false;

                var obj = PMS.BAL.UserBO.ValidateUser(login, password);
                if (obj != null)
                {
                    flag = true;
                    SessionManager.User = obj;

                    if (obj.IsAdmin == true)
                        url = Url.Content("~/Home/Admin");
                    else
                        url = Url.Content("~/Home/NormalUser");
                }

                data = new
                {
                    valid = flag,
                    urlToRedirect = url
                };
            }
            catch (Exception)
            {
                data = new
                {
                    valid = false,
                    urlToRedirect = ""
                };
            }

            return Json(data, JsonRequestBehavior.AllowGet);
        }
	}
}