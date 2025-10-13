using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Clients
{
    [Authorize(Roles = "Admin")]
    public class IndexModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public IndexModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        public string CurrentFilter { get; set; }
        public string NameSort { get; set; }

        public IList<Client> Client { get; set; } = default!;

        public async Task OnGetAsync(string sortOrder, string searchString)
        {
            // Sortare și filtrare
            NameSort = String.IsNullOrEmpty(sortOrder) ? "name_desc" : "";
            CurrentFilter = searchString;

            var clientsQuery = _context.Client.AsQueryable();

            // Filtrare după nume
            if (!String.IsNullOrEmpty(searchString))
            {
                clientsQuery = clientsQuery.Where(c =>
                    c.FirstName.Contains(searchString) || c.LastName.Contains(searchString));
            }

            // Sortare
            clientsQuery = sortOrder switch
            {
                "name_desc" => clientsQuery.OrderByDescending(c => c.LastName),
                _ => clientsQuery.OrderBy(c => c.LastName),
            };

            Client = await clientsQuery.ToListAsync();
        }
    }
}
