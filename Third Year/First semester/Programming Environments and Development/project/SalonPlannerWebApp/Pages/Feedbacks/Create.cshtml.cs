using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.AspNetCore.Mvc.Rendering;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Feedbacks
{
    [Authorize(Roles = "User")]

    public class CreateModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public CreateModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        public IActionResult OnGet()
        {
           

            // Populează lista pentru angajați
            ViewData["EmployeeID"] = new SelectList(
                _context.Employee.Select(e => new
                {
                    ID = e.Id,
                    FullName = e.FirstName + " " + e.LastName
                }),
                "ID",
                "FullName"
            );

            // Populează lista pentru servicii
            ViewData["ServiceID"] = new SelectList(
                _context.Service,
                "ID",
                "Name"
            );
            return Page();
        }

        [BindProperty]
        public Feedback Feedback { get; set; } = default!;

        // For more information, see https://aka.ms/RazorPagesCRUD.
        public async Task<IActionResult> OnPostAsync()
        {
            if (!ModelState.IsValid)
            {
                return Page();
            }

            _context.Feedback.Add(Feedback);
            await _context.SaveChangesAsync();

            return RedirectToPage("./Index");
        }
    }
}
