using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.AppointmentsClients
{
    public class IndexModel : PageModel
    {
        private readonly SalonPlannerWebAppContext _context;
        private readonly UserManager<IdentityUser> _userManager;

        public IndexModel(SalonPlannerWebAppContext context, UserManager<IdentityUser> userManager)
        {
            _context = context;
            _userManager = userManager;
        }

        public IList<Appointment> Appointment { get; set; } = default!;
        public string CurrentFilter { get; set; }
        public string DateSort { get; set; }

        public async Task<IActionResult> OnGetAsync(string sortOrder, string searchDate)
        {
            // Obține utilizatorul logat
            var user = await _userManager.GetUserAsync(User);
            if (user == null)
            {
                return Unauthorized(); // Redirecționează dacă utilizatorul nu este autentificat
            }

            // Obține email-ul utilizatorului logat
            var userEmail = user.Email;

            // Verifică dacă utilizatorul este un client în baza de date
            var client = await _context.Client.FirstOrDefaultAsync(c => c.Email == userEmail);
            if (client == null)
            {
                return Forbid(); // Dacă utilizatorul logat nu este client, interzice accesul
            }

            // Inițializare sortare și filtrare
            DateSort = String.IsNullOrEmpty(sortOrder) ? "date_desc" : "";
            CurrentFilter = searchDate;

            // Obține programările pentru clientul logat
            var appointmentsQuery = _context.Appointment
                .Where(a => a.ClientID == client.ID) // Filtru pe baza ClientID
                .Include(a => a.Client)
                .Include(a => a.Employee)
                .Include(a => a.Service)
                .AsQueryable();

            // Filtrare după dată
            if (!String.IsNullOrEmpty(searchDate) && DateTime.TryParse(searchDate, out var filterDate))
            {
                appointmentsQuery = appointmentsQuery.Where(a => a.Date.Date == filterDate.Date);
            }

            // Sortare după dată
            appointmentsQuery = sortOrder switch
            {
                "date_desc" => appointmentsQuery.OrderByDescending(a => a.Date),
                _ => appointmentsQuery.OrderBy(a => a.Date),
            };

            Appointment = await appointmentsQuery.ToListAsync();

            return Page();
        }
    }
}
