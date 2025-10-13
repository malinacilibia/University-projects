using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Appointments
{
    public class IndexModel : PageModel
    {
        private readonly SalonPlannerWebAppContext _context;

        public IndexModel(SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        public string CurrentFilter { get; set; }
        public string ClientSort { get; set; }
        public string DateSort { get; set; }

        public IList<Appointment> Appointment { get; set; } = default!;

        public async Task OnGetAsync(string sortOrder, string searchString)
        {
            // Sortare pe baza Client sau Dată
            ClientSort = String.IsNullOrEmpty(sortOrder) ? "client_desc" : "";
            DateSort = sortOrder == "date" ? "date_desc" : "date";

            CurrentFilter = searchString;

            var appointments = from a in _context.Appointment
                               .Include(a => a.Client)
                               .Include(a => a.Employee)
                               .Include(a => a.Service)
                               select a;

            // Filtrare după numele clientului
            if (!String.IsNullOrEmpty(searchString))
            {
                appointments = appointments.Where(a => a.Client.FirstName.Contains(searchString) ||
                                                        a.Client.LastName.Contains(searchString));
            }

            // Sortare
            switch (sortOrder)
            {
                case "client_desc":
                    appointments = appointments.OrderByDescending(a => a.Client.FirstName);
                    break;
                case "date":
                    appointments = appointments.OrderBy(a => a.Date);
                    break;
                case "date_desc":
                    appointments = appointments.OrderByDescending(a => a.Date);
                    break;
                default:
                    appointments = appointments.OrderBy(a => a.Client.FirstName);
                    break;
            }

            Appointment = await appointments.ToListAsync();
        }
    }
}
