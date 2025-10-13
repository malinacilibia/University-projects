using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Feedbacks
{
    [Authorize(Roles = "User")]

    public class EditModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public EditModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
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
                .FirstOrDefaultAsync(a => a.ID == id);

            if (Feedback == null)
            {
                return NotFound();
            }

            // Populează listele derulante pentru clienți, angajați și servicii
          

            ViewData["EmployeeID"] = new SelectList(
                _context.Employee.Select(e => new
                {
                    ID = e.Id,
                    FullName = e.FirstName + " " + e.LastName
                }),
                "ID",
                "FullName",
                Feedback.EmployeeID // selectează angajatul curent
            );

            ViewData["ServiceID"] = new SelectList(
                _context.Service,
                "ID",
                "Name",
                Feedback.ServiceID // selectează serviciul curent
            );

            return Page();
        }


        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more information, see https://aka.ms/RazorPagesCRUD.
        public async Task<IActionResult> OnPostAsync()
        {
            if (!ModelState.IsValid)
            {
                return Page();
            }

            _context.Attach(Feedback).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!FeedbackExists(Feedback.ID))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return RedirectToPage("./Index");
        }

        private bool FeedbackExists(int id)
        {
            return _context.Feedback.Any(e => e.ID == id);
        }
    }
}
