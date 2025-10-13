using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Data;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Pages.Feedbacks
{
    public class IndexModel : PageModel
    {
        private readonly SalonPlannerWebApp.Data.SalonPlannerWebAppContext _context;

        public IndexModel(SalonPlannerWebApp.Data.SalonPlannerWebAppContext context)
        {
            _context = context;
        }

        public IList<Feedback> Feedback { get;set; } = default!;

        public async Task OnGetAsync()
        {
            Feedback = await _context.Feedback
                .Include(f => f.Employee)
                .Include(f => f.Service)
                .Include(f => f.Service).ToListAsync();
        }
    }
}
