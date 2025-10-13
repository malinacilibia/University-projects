using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Services
{
    [Authorize(Roles = "Admin")]

    public class CreateModel : ServiceCategoriesPageModel
    {
        private readonly SalonPlannerWebAppContext _context;

        public CreateModel(SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        public IActionResult OnGet()
        {
            var service = new Service
            {
                ServiceCategories = new List<ServiceCategory>()
            };

            PopulateAssignedCategoryData(_context, service);
            return Page();
        }

        [BindProperty]
        public Service Service { get; set; } // legatura intre modelul Service si formular

        public async Task<IActionResult> OnPostAsync(string[] selectedCategories)
        {
            var newService = new Service(); // creeaza un obiect pentru noul serviciu

            if (selectedCategories != null) // verifica daca au fost selectate categorii
            {
                newService.ServiceCategories = new List<ServiceCategory>(); // initializeaza lista de categorii
                foreach (var category in selectedCategories) // itereaza prin categoriile selectate
                {
                    newService.ServiceCategories.Add(new ServiceCategory
                    {
                        CategoryID = int.Parse(category) // adauga fiecare categorie in lista
                    });
                }
            }

            Service.ServiceCategories = newService.ServiceCategories; // asociaza categoriile noului serviciu
            _context.Service.Add(Service); // adauga serviciul in baza de date
            await _context.SaveChangesAsync(); // salveaza modificarile
            return RedirectToPage("./Index"); 
        }

    }
}
