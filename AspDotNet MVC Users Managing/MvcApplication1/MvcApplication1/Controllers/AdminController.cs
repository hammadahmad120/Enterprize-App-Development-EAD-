using Assignment4;
using MvcApplication1.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace MvcApplication1.Controllers
{
    public class AdminController : Controller
    {
        //
        // GET: /Admin/

        public ActionResult Alogin()
        {
            return View();
        }
        public ActionResult Edit(int id)
        {
            var obj = new User();
            var Dobj = new ADOusers();
            obj = Dobj.getUserbyId(id);
            Session["login"] = obj.Login;
            Session["admin"] = "yes";
            TempData["adm"] = "yes";
            return Redirect("/user/edituser"); 
            //return View("/User/EditUser", obj);
        }
        public ActionResult HomeAdmin()
        {
            if (Request["txtlogin"] == null || Request["txtpassword"] == null)
            {
                ViewData["Err"] = "Both login and password mandatory";
                return View("ALogin");
            }
            var Login = Request["txtlogin"];
            var pass = Request["txtpassword"];
            var obj = new ADOadmin();
            if (obj.validateAdmin(Login, pass))
            {
                var obj1 = new ADOusers();
                var lst = obj1.getAllUsersList();
                ViewData["list"] = lst;
                ViewData["Err"] = null;
                return View(lst);
            }
            else
            {
                ViewData["Err"] = "Invalid login or Password";
                return View("Alogin");
            }
        }

        public ActionResult HomeAdmin2()
        {

            Session["admin"] = null;
          
                var obj1 = new ADOusers();
                var lst = obj1.getAllUsersList();
                ViewData["list"] = lst;
                return View("HomeAdmin",lst);
            
        }

    }
}
