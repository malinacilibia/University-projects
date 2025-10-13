using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Services
{
    [Authorize(Roles = "Admin")]

    public class EditModel : ServiceCategoriesPageModel
    {
        private readonly SalonPlannerWebAppContext _context;

        public EditModel(SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        [BindProperty]
        public Service Service { get; set; }

        public async Task<IActionResult> OnGetAsync(int? id)
        {
            if (id == null)
            {
                Console.WriteLine("ID is null");
                return NotFound();
            }

            Service = await _context.Service
                .Include(s => s.ServiceCategories)
                .ThenInclude(sc => sc.Category)
                .FirstOrDefaultAsync(m => m.ID == id);


            if (Service == null)
            {
                Console.WriteLine($"Service with ID {id} not found.");
                return NotFound();
            }

            Console.WriteLine($"Service retrieved: {Service.Name}, {Service.Description}");
            PopulateAssignedCategoryData(_context, Service);
            return Page();
        }

        public async Task<IActionResult> OnPostAsync(int? id, string[] selectedCategories)
        {
            if (id == null)
            {
                return NotFound();
            }

            var serviceToUpdate = await _context.Service
                .Include(s => s.ServiceCategories)
                .ThenInclude(i => i.Category)
                .FirstOrDefaultAsync(s => s.ID == id);

            if (serviceToUpdate == null)
            {
                return NotFound();
            }

            if (await TryUpdateModelAsync(serviceToUpdate, "Service", s => s.Name, s => s.Description, s => s.Price, s => s.Duration))
            {
                UpdateServiceCategories(_context, selectedCategories, serviceToUpdate);
                await _context.SaveChangesAsync();
                return RedirectToPage("./Index");
            }
            if (!await TryUpdateModelAsync(
                serviceToUpdate,
                "Service",
                s => s.Name, s => s.Description, s => s.Price, s => s.Duration))
            {
               
                PopulateAssignedCategoryData(_context, serviceToUpdate);
                return Page();
            }


            UpdateServiceCategories(_context, selectedCategories, serviceToUpdate);
            PopulateAssignedCategoryData(_context, serviceToUpdate);
            return Page();
        }
    }
}
