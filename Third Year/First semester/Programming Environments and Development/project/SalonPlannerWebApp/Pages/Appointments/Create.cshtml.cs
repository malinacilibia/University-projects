using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.AspNetCore.Mvc.Rendering;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Appointments
{
    public class CreateModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public CreateModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        public IActionResult OnGet()
        {
            // Populează lista pentru clienți
            ViewData["ClientID"] = new SelectList(
                _context.Client.Select(c => new
                {
                    ID = c.ID,
                    FullName = c.FirstName + " " + c.LastName
                }),
                "ID",
                "FullName"
            );

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
        public Appointment Appointment { get; set; } = default!;

        // For more information, see https://aka.ms/RazorPagesCRUD.
        public async Task<IActionResult> OnPostAsync()
        {
            if (!ModelState.IsValid)
            {
                return Page();
            }
            Appointment.Status = AppointmentStatus.Pending; // Setăm statusul implicit

            _context.Appointment.Add(Appointment);
            await _context.SaveChangesAsync();

            return RedirectToPage("./Index");
        }
    }
}
