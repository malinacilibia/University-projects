using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.AppointmentsClients
{
    public class DeleteModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public DeleteModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
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

            var appointment = await _context.Appointment.FirstOrDefaultAsync(m => m.ID == id);

            if (appointment == null)
            {
                return NotFound();
            }
            else
            {
                Appointment = appointment;
            }
            return Page();
        }

        public async Task<IActionResult> OnPostAsync(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var appointment = await _context.Appointment.FindAsync(id);
            if (appointment != null)
            {
                Appointment = appointment;
                _context.Appointment.Remove(Appointment);
                await _context.SaveChangesAsync();
            }

            return RedirectToPage("./Index");
        }
    }
}
