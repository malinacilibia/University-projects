using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace SalonPlannerWebApp.Migrations
{
    /// <inheritdoc />
    public partial class ServiceCategory : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<int>(
                name: "CategoryID",
                table: "Service",
                type: "int",
                nullable: true);

            migrationBuilder.CreateTable(
                name: "Category",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Name = table.Column<string>(type: "nvarchar(50)", maxLength: 50, nullable: false),
                    Description = table.Column<string>(type: "nvarchar(250)", maxLength: 250, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Category", x => x.ID);
                });

            migrationBuilder.CreateTable(
                name: "ServiceCategory",
                columns: table => new
                {
                    ID = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    ServiceId = table.Column<int>(type: "int", nullable: false),
                    CategoryID = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_ServiceCategory", x => x.ID);
                    table.ForeignKey(
                        name: "FK_ServiceCategory_Category_CategoryID",
                        column: x => x.CategoryID,
                        principalTable: "Category",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_ServiceCategory_Service_ServiceId",
                        column: x => x.ServiceId,
                        principalTable: "Service",
                        principalColumn: "ID",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_Service_CategoryID",
                table: "Service",
                column: "CategoryID");

            migrationBuilder.CreateIndex(
                name: "IX_ServiceCategory_CategoryID",
                table: "ServiceCategory",
                column: "CategoryID");

            migrationBuilder.CreateIndex(
                name: "IX_ServiceCategory_ServiceId",
                table: "ServiceCategory",
                column: "ServiceId");

            migrationBuilder.AddForeignKey(
                name: "FK_Service_Category_CategoryID",
                table: "Service",
                column: "CategoryID",
                principalTable: "Category",
                principalColumn: "ID");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Service_Category_CategoryID",
                table: "Service");

            migrationBuilder.DropTable(
                name: "ServiceCategory");

            migrationBuilder.DropTable(
                name: "Category");

            migrationBuilder.DropIndex(
                name: "IX_Service_CategoryID",
                table: "Service");

            migrationBuilder.DropColumn(
                name: "CategoryID",
                table: "Service");
        }
    }
}
