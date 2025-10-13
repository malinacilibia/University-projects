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

namespace SalonPlannerWebApp.Pages.Employees
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

        public IList<Employee> Employee { get; set; } = default!;

        public async Task OnGetAsync(string sortOrder, string searchString)
        {
            // Sortare și filtrare
            NameSort = String.IsNullOrEmpty(sortOrder) ? "name_desc" : "";
            CurrentFilter = searchString;

            var employeesQuery = _context.Employee.AsQueryable();

            // Filtrare după nume
            if (!String.IsNullOrEmpty(searchString))
            {
                employeesQuery = employeesQuery.Where(e =>
                    e.FirstName.Contains(searchString) || e.LastName.Contains(searchString));
            }

            // Sortare
            employeesQuery = sortOrder switch
            {
                "name_desc" => employeesQuery.OrderByDescending(e => e.LastName),
                _ => employeesQuery.OrderBy(e => e.LastName),
            };

            Employee = await employeesQuery.ToListAsync();
        }
    }
}
