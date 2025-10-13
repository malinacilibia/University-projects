using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Appointments
{
    [Authorize(Roles = "Admin")]
    public class EditModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public EditModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        [BindProperty]
        public Appointment Appointment { get; set; } = default!;

        public async Task<IActionResult> OnGetAsync(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            Appointment = await _context.Appointment
                .Include(a => a.Client)
                .Include(a => a.Employee)
                .Include(a => a.Service)
                .FirstOrDefaultAsync(a => a.ID == id);

            if (Appointment == null)
            {
                return NotFound();
            }

            // Populează listele derulante pentru clienți, angajați și servicii
            ViewData["ClientID"] = new SelectList(
                _context.Client.Select(c => new
                {
                    ID = c.ID,
                    FullName = c.FirstName + " " + c.LastName
                }),
                "ID",
                "FullName",
                Appointment.ClientID // selectează clientul curent
            );

            ViewData["EmployeeID"] = new SelectList(
                _context.Employee.Select(e => new
                {
                    ID = e.Id,
                    FullName = e.FirstName + " " + e.LastName
                }),
                "ID",
                "FullName",
                Appointment.EmployeeID // selectează angajatul curent
            );

            ViewData["ServiceID"] = new SelectList(
                _context.Service,
                "ID",
                "Name",
                Appointment.ServiceID // selectează serviciul curent
            );

            return Page();
        }


        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more information, see https://aka.ms/RazorPagesCRUD.
        public async Task<IActionResult> OnPostAsync()
        {
            if (!ModelState.IsValid)
            {
                // reincarca listele derulante daca formularul nu este valid
                ViewData["ClientID"] = new SelectList(
                    _context.Client.Select(c => new
                    {
                        ID = c.ID,
                        FullName = c.FirstName + " " + c.LastName
                    }),
                    "ID",
                    "FullName",
                    Appointment.ClientID
                );

                ViewData["EmployeeID"] = new SelectList(
                    _context.Employee.Select(e => new
                    {
                        ID = e.Id,
                        FullName = e.FirstName + " " + e.LastName
                    }),
                    "ID",
                    "FullName",
                    Appointment.EmployeeID
                );

                ViewData["ServiceID"] = new SelectList(
                    _context.Service,
                    "ID",
                    "Name",
                    Appointment.ServiceID
                );

                return Page();
            }

            // gaseste programarea ce trebuie actualizata
            var appointmentToUpdate = await _context.Appointment
                .FirstOrDefaultAsync(a => a.ID == Appointment.ID);

            if (appointmentToUpdate == null)
            {
                return NotFound();
            }

            // actualizeaza campurile programarii
            appointmentToUpdate.ClientID = Appointment.ClientID;
            appointmentToUpdate.EmployeeID = Appointment.EmployeeID;
            appointmentToUpdate.ServiceID = Appointment.ServiceID;
            appointmentToUpdate.Date = Appointment.Date;
            appointmentToUpdate.Duration = Appointment.Duration;
            appointmentToUpdate.Status = Appointment.Status;

            // salveaza modificarile in baza de date
            await _context.SaveChangesAsync();
            return RedirectToPage("./Index");
        }



        private bool AppointmentExists(int id)
        {
            return _context.Appointment.Any(e => e.ID == id);
        }
    }
}
