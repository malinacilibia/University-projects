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
    public class DetailsModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public DetailsModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

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
                .FirstOrDefaultAsync(m => m.ID == id);

            if (Appointment == null)
            {
                return NotFound();
            }

            return Page();
        }
    }
}
