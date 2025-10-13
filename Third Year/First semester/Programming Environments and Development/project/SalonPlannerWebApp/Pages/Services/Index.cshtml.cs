using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace SalonPlannerWebApp.Pages.Services
{
    public class IndexModel : PageModel
    {
        private readonly SalonPlannerWebAppContext _context;

        public IndexModel(SalonPlannerWebAppContext context)
        {
            _context = context; 
        }

        public string CategorySort { get; set; } 
        public string CurrentSort { get; set; } 

        public IList<Service> Service { get; set; } 
        public ServiceData ServiceD { get; set; } 
        public int ServiceID { get; set; } 
        public int CategoryID { get; set; } 

        public async Task OnGetAsync(int? id, int? categoryID, string sortOrder)
        {
            ServiceD = new ServiceData(); // initializeaza structura pentru servicii si categorii

            CategorySort = string.IsNullOrEmpty(sortOrder) ? "category_desc" : "";
            CurrentSort = sortOrder; 

            // interogheaza serviciile cu toate categoriile asociate
            var servicesQuery = _context.Service
                .Include(s => s.ServiceCategories) // include relatiile dintre servicii si categorii
                .ThenInclude(sc => sc.Category) // include detaliile despre categorii
                .AsNoTracking(); 

            switch (sortOrder)
            {
                case "category_desc":
                    servicesQuery = servicesQuery.OrderByDescending(s => s.ServiceCategories.FirstOrDefault().Category.Name);
                    break;
                default:
                    servicesQuery = servicesQuery.OrderBy(s => s.ServiceCategories.FirstOrDefault().Category.Name);
                    break;
            }

            // obtine lista finala de servicii dupa aplicarea sortarii
            ServiceD.Services = await servicesQuery.ToListAsync();

            if (id != null) // verifica daca a fost selectat un serviciu
            {
                ServiceID = id.Value; // seteaza id-ul serviciului selectat

                // gaseste serviciul selectat in lista
                Service service = ServiceD.Services
                    .Where(s => s.ID == id.Value).Single();

                // obtine categoriile asociate serviciului selectat
                ServiceD.Categories = service.ServiceCategories.Select(sc => sc.Category);
            }
        }
    }
}
