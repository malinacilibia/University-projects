using Microsoft.AspNetCore.Mvc.RazorPages;
using SalonPlannerWebApp.Data;

namespace SalonPlannerWebApp.Models
{
    public class ServiceCategoriesPageModel : PageModel
    {
        // lista pentru a stoca datele categoriilor asignate
        public List<AssignedCategoryData> AssignedCategoryDataList;

        // metoda pentru popularea datelor despre categoriile asignate unui serviciu
        public void PopulateAssignedCategoryData(SalonPlannerWebAppContext context, Service service)
        {
            // obtine toate categoriile din baza de date
            var allCategories = context.Category;

            // creeaza un set de id-uri ale categoriilor asignate serviciului
            var serviceCategories = new HashSet<int>(service.ServiceCategories.Select(c => c.CategoryID));
            AssignedCategoryDataList = new List<AssignedCategoryData>();

            // parcurge toate categoriile si adauga in lista AssignedCategoryDataList
            foreach (var category in allCategories)
            {
                AssignedCategoryDataList.Add(new AssignedCategoryData
                {
                    CategoryID = category.ID,
                    Name = category.Name,
                    Assigned = serviceCategories.Contains(category.ID) // verifica daca categoria este asignata
                });
            }
        }

        // metoda pentru actualizarea categoriilor asignate unui serviciu
        public void UpdateServiceCategories(SalonPlannerWebAppContext context, string[] selectedCategories, Service serviceToUpdate)
        {
            // daca nu sunt selectate categorii, elimina toate categoriile asignate
            if (selectedCategories == null)
            {
                Console.WriteLine("No categories selected.");
                serviceToUpdate.ServiceCategories = new List<ServiceCategory>();
                return;
            }
            Console.WriteLine($"Selected Categories: {string.Join(", ", selectedCategories)}");

            // creeaza un set de categorii selectate si un set de categorii asignate
            var selectedCategoriesHS = new HashSet<string>(selectedCategories);
            var serviceCategories = new HashSet<int>(serviceToUpdate.ServiceCategories.Select(c => c.CategoryID));
            Console.WriteLine($"Existing Service Categories: {string.Join(", ", serviceCategories)}");

            // parcurge toate categoriile din baza de date
            foreach (var category in context.Category)
            {
                // daca categoria este selectata dar nu este asignata, adauga asocierea
                if (selectedCategoriesHS.Contains(category.ID.ToString()))
                {
                    if (!serviceCategories.Contains(category.ID))
                    {
                        Console.WriteLine($"Adding Category: {category.ID} - {category.Name}");

                        serviceToUpdate.ServiceCategories.Add(new ServiceCategory
                        {
                            ServiceId = serviceToUpdate.ID,
                            CategoryID = category.ID
                        });
                    }
                }
                else
                {
                    // daca categoria este asignata dar nu este selectata, elimina asocierea
                    if (serviceCategories.Contains(category.ID))
                    {
                        Console.WriteLine($"Removing Category: {category.ID} - {category.Name}");

                        var serviceCategoryToRemove = serviceToUpdate.ServiceCategories
                            .SingleOrDefault(sc => sc.CategoryID == category.ID);
                        context.Remove(serviceCategoryToRemove);
                    }
                }
            }
        }
    }
}
