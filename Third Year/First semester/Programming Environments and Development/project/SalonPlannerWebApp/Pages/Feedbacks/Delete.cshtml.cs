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

namespace SalonPlannerWebApp.Pages.Feedbacks
{
    [Authorize(Roles = "User")]

    public class DeleteModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public DeleteModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        [BindProperty]
        public Feedback Feedback { get; set; } = default!;

        public async Task<IActionResult> OnGetAsync(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            Feedback = await _context.Feedback
                .Include(a => a.Employee)
                .Include(a => a.Service)
                .FirstOrDefaultAsync(m => m.ID == id);

            if (Feedback == null)
            {
                return NotFound();
            }

            return Page();
        }

        public async Task<IActionResult> OnPostAsync(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var feedback = await _context.Feedback.FindAsync(id);
            if (feedback != null)
            {
                Feedback = feedback;
                _context.Feedback.Remove(Feedback);
                await _context.SaveChangesAsync();
            }

            return RedirectToPage("./Index");
        }
    }
}
