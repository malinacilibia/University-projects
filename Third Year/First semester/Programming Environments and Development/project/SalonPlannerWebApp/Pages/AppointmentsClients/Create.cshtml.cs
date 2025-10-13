using System;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.AspNetCore.Mvc.RazorPages;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;
using Microsoft.EntityFrameworkCore;

namespace SalonPlannerWebApp.Pages.AppointmentsClients
{
    public class CreateModel : PageModel
    {
        private readonly SalonPlannerWebAppContext _context;
        private readonly UserManager<IdentityUser> _userManager;

        public CreateModel(SalonPlannerWebAppContext context, UserManager<IdentityUser> userManager)
        {
            _context = context;
            _userManager = userManager;
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

        public async Task<IActionResult> OnPostAsync()
        {
            if (!ModelState.IsValid)
            {
                return Page();
            }
            Appointment.Status = AppointmentStatus.Pending; // Setăm statusul implicit


            // Obține utilizatorul logat
            var user = await _userManager.GetUserAsync(User);
            if (user == null)
            {
                return Unauthorized(); // Asigură-te că utilizatorul este autentificat
            }

            // Obține clientul asociat utilizatorului logat
            var client = await _context.Client.FirstOrDefaultAsync(c => c.Email == user.Email);
            if (client == null)
            {
                return Forbid(); // Dacă utilizatorul logat nu este asociat unui client
            }

            // Setează automat ClientID bazat pe utilizatorul logat
            Appointment.ClientID = client.ID;

            _context.Appointment.Add(Appointment);
            await _context.SaveChangesAsync();

            return RedirectToPage("./Index");
        }
    }
}
