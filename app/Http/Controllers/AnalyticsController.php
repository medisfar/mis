<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * List all available analytics endpoints
     */
    public function index()
    {
        return response()->json([
            'endpoints' => [
                '/api/analytics/projects' => 'Project Analytics',
                '/api/analytics/sites' => 'Site Analytics',
                '/api/analytics/groupements' => 'Groupement Analytics',
                '/api/analytics/activities' => 'Activity Analytics',
                '/api/analytics/members' => 'Member Demographics',
                '/api/analytics/financial' => 'Financial Analytics',
                '/api/analytics/localities' => 'Geographic Analytics',
                '/api/analytics/tasks' => 'Task Analytics',
                '/api/analytics/dashboard' => 'Dashboard Overview',
            ]
        ]);
    }

    /**
     * Project Analytics
     */
    public function projects()
    {
        $data = DB::select("
            SELECT 
                p.code AS project_code,
                a.activite,
                s.nom,
                p.nom_projet AS project_name,
                p.budget AS budget,
                p.date_debut AS start_date,
                p.date_fin AS end_date,
                p.l_statut AS status,
                COUNT(DISTINCT s.id) AS site_count,
                COUNT(DISTINCT a.id) AS activity_count,
                COUNT(DISTINCT t.id) AS task_count,
                SUM(t.budget) AS total_task_budget,
                SUM(a.budget) AS total_activity_budget
            FROM projets p
            LEFT JOIN sites s ON s.projet_id = p.id
            LEFT JOIN activites a ON a.id IN (
                SELECT activite_id FROM activite_site WHERE site_id = s.id
            )
            LEFT JOIN taches t ON t.projet_id = p.id
            GROUP BY p.id
        ");

        return response()->json([
            'title' => 'Project Analytics',
            'description' => 'Overview of all projects with budgets, activities, and tasks',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Site Analytics
     */
    public function sites()
    {
        $data = DB::select("
            SELECT 
                s.nom AS site_name,
                s.type_point_focal AS focal_type,
                s.nom_point_focal AS focal_name,
                l.nom_localite AS locality,
                COUNT(DISTINCT g.id) AS groupement_count,
                COUNT(DISTINCT m.id) AS member_count,
                COUNT(DISTINCT a.id) AS activity_count,
                COUNT(DISTINCT t.id) AS task_count,
                SUM(t.budget) AS total_budget,
                SUM(t.engage) AS total_engaged,
                (SUM(t.engage) / NULLIF(SUM(t.budget), 0) * 100) AS engagement_rate
            FROM sites s
            LEFT JOIN localites l ON l.id = s.localite_id
            LEFT JOIN groupements g ON g.site_id = s.id
            LEFT JOIN groupement_membre gm ON gm.groupement_id = g.id
            LEFT JOIN membres m ON m.id = gm.membre_id
            LEFT JOIN activite_site a_s ON a_s.site_id = s.id
            LEFT JOIN activites a ON a.id = a_s.activite_id
            LEFT JOIN taches t ON t.site_id = s.id
            GROUP BY s.id
        ");

        return response()->json([
            'title' => 'Site Analytics',
            'description' => 'Detailed analysis of all sites with activities and budgets',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Groupement Analytics
     */
    public function groupements()
    {
        $data = DB::select("
            SELECT 
                g.nom_groupe AS group_name,
                s.nom AS site_name,
                COUNT(DISTINCT gm.membre_id) AS member_count,
                COUNT(DISTINCT m.menage_id) AS household_count,
                COUNT(DISTINCT l.id) AS session_count,
                COUNT(DISTINCT d.id) AS data_records,
                SUM(CASE WHEN m.genre = 1 THEN 1 ELSE 0 END) AS male_members,
                SUM(CASE WHEN m.genre = 2 THEN 1 ELSE 0 END) AS female_members,
                SUM(CASE WHEN m.enceinte = 1 THEN 1 ELSE 0 END) AS pregnant_members
            FROM groupements g
            LEFT JOIN sites s ON s.id = g.site_id
            LEFT JOIN groupement_membre gm ON gm.groupement_id = g.id
            LEFT JOIN membres m ON m.id = gm.membre_id
            LEFT JOIN lessessions l ON l.groupement_id = g.id
            LEFT JOIN donnees d ON d.groupement_id = g.id
            GROUP BY g.id
        ");

        return response()->json([
            'title' => 'Groupement Analytics',
            'description' => 'Member and household statistics by groupement',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Activity Analytics
     */
    public function activities()
    {
        $data = DB::select("
            SELECT 
                a.activite AS activity_name,
                c.description AS component,
                sc.description AS sub_component,
                l.nom_localite AS locality,
                a.date_debut AS start_date,
                a.date_fin AS end_date,
                a.budget AS budget,
                COUNT(DISTINCT s.id) AS site_count,
                COUNT(DISTINCT t.id) AS task_count,
                SUM(t.budget) AS task_budget,
                SUM(t.engage) AS engaged_amount,
                COUNT(DISTINCT p.id) AS product_count,
                CASE 
                    WHEN a.statut = 1 THEN 'Active'
                    WHEN a.statut = 0 THEN 'Inactive'
                    ELSE 'Other'
                END AS status_label
            FROM activites a
            LEFT JOIN composantes c ON c.id = a.composante_id
            LEFT JOIN souscomposantes sc ON sc.id = a.sous_composante_id
            LEFT JOIN localites l ON l.id = a.localite_id
            LEFT JOIN activite_site a_s ON a_s.activite_id = a.id
            LEFT JOIN sites s ON s.id = a_s.site_id
            LEFT JOIN taches t ON t.activite_id = a.id
            LEFT JOIN activite_produit a_p ON a_p.activite_id = a.id
            LEFT JOIN produits p ON p.id = a_p.produit_id
            GROUP BY a.id
        ");

        return response()->json([
            'title' => 'Activity Analytics',
            'description' => 'Activity performance and budget tracking',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Member Demographics
     */
    public function members()
    {
        $data = DB::select("
            SELECT 
                m.nom AS member_name,
                m.genre AS gender,
                m.date_naissance AS birth_date,
                TIMESTAMPDIFF(YEAR, m.date_naissance, CURDATE()) AS age,
                CASE WHEN m.lien_parente = 1 THEN 'Head' 
                     WHEN m.lien_parente = 2 THEN 'Spouse'
                     ELSE 'Other' 
                END AS relationship,
                m.enceinte AS is_pregnant,
                g.nom_groupe AS group_name,
                s.nom AS site_name,
                l.nom_localite AS locality,
                COUNT(DISTINCT d.id) AS data_entries,
                COUNT(DISTINCT cr.id) AS credit_count,
                SUM(cr.montant) AS total_credit,
                COUNT(DISTINCT e.id) AS echeance_count
            FROM membres m
            LEFT JOIN groupement_membre gm ON gm.membre_id = m.id
            LEFT JOIN groupements g ON g.id = gm.groupement_id
            LEFT JOIN sites s ON s.id = g.site_id
            LEFT JOIN localites l ON l.id = s.localite_id
            LEFT JOIN donnees d ON d.membre_id = m.id
            LEFT JOIN credits cr ON cr.membre_id = m.id
            LEFT JOIN echeances e ON e.membre_id = m.id
            GROUP BY m.id
        ");

        return response()->json([
            'title' => 'Member Demographics',
            'description' => 'Demographic analysis of all members',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Financial Analytics
     */
    public function financial()
    {
        $data = DB::select("
            SELECT 
                p.nom_projet AS project_name,
                p.budget AS project_budget,
                SUM(t.budget) AS total_task_budget,
                SUM(t.engage) AS total_engaged,
                (SUM(t.engage) / NULLIF(SUM(t.budget), 0) * 100) AS engagement_rate,
                COUNT(DISTINCT a.id) AS activity_count,
                SUM(a.budget) AS total_activity_budget,
                COUNT(DISTINCT b.id) AS bailleur_count,
                SUM(bp.budget) AS bailleur_budget,
                (SUM(bp.budget) / NULLIF(p.budget, 0) * 100) AS funding_coverage
            FROM projets p
            LEFT JOIN taches t ON t.projet_id = p.id
            LEFT JOIN activites a ON a.id IN (
                SELECT activite_id FROM activite_site WHERE site_id IN (SELECT id FROM sites WHERE projet_id = p.id)
            )
            LEFT JOIN bailleur_projet bp ON bp.projet_id = p.id
            LEFT JOIN bailleurs b ON b.id = bp.bailleur_id
            GROUP BY p.id
        ");

        return response()->json([
            'title' => 'Financial Analytics',
            'description' => 'Budget, funding, and financial performance',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Geographic Analytics
     */
    public function localities()
    {
        $data = DB::select("
            SELECT 
                r.nom_region AS region,
                p.nom_prefecture AS prefecture,
                sp.nom_ssprefecture AS sub_prefecture,
                l.nom_localite AS locality,
                l.l_type AS locality_type,
                COUNT(DISTINCT s.id) AS site_count,
                COUNT(DISTINCT g.id) AS groupement_count,
                COUNT(DISTINCT m.id) AS member_count,
                COUNT(DISTINCT a.id) AS activity_count,
                SUM(a.budget) AS total_budget,
                COUNT(DISTINCT z.id) AS zone_count
            FROM localites l
            LEFT JOIN ssprefectures sp ON sp.id = l.ssprefecture_id
            LEFT JOIN prefectures p ON p.id = sp.prefecture_id
            LEFT JOIN regions r ON r.id = p.region_id
            LEFT JOIN sites s ON s.localite_id = l.id
            LEFT JOIN groupements g ON g.site_id = s.id
            LEFT JOIN membres m ON m.id IN (
                SELECT membre_id FROM groupement_membre WHERE groupement_id = g.id
            )
            LEFT JOIN activites a ON a.localite_id = l.id
            LEFT JOIN zones z ON z.localite_id = l.id
            GROUP BY l.id
        ");

        return response()->json([
            'title' => 'Geographic Analytics',
            'description' => 'Regional and locality-level analysis',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Task Analytics
     */
    public function tasks()
    {
        $data = DB::select("
            SELECT 
                t.tache AS task_name,
                a.activite AS activity_name,
                p.nom_projet AS project_name,
                s.nom AS site_name,
                t.budget AS task_budget,
                t.engage AS engaged_amount,
                (t.engage / NULLIF(t.budget, 0) * 100) AS engagement_rate,
                t.date_debut AS start_date,
                t.date_fin AS end_date,
                CASE 
                    WHEN t.completed = 1 THEN 'Completed'
                    ELSE 'In Progress'
                END AS status,
                DATEDIFF(t.date_fin, t.date_debut) AS duration_days
            FROM taches t
            LEFT JOIN activites a ON a.id = t.activite_id
            LEFT JOIN projets p ON p.id = t.projet_id
            LEFT JOIN sites s ON s.id = t.site_id
            GROUP BY t.id
        ");

        return response()->json([
            'title' => 'Task Analytics',
            'description' => 'Task completion and performance tracking',
            'data' => $data,
            'total' => count($data)
        ]);
    }

    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $data = DB::select("
            SELECT 
                (SELECT COUNT(*) FROM projets) AS total_projects,
                (SELECT COUNT(*) FROM sites) AS total_sites,
                (SELECT COUNT(*) FROM groupements) AS total_groupements,
                (SELECT COUNT(*) FROM membres) AS total_members,
                (SELECT COUNT(*) FROM activites) AS total_activities,
                (SELECT COUNT(*) FROM taches) AS total_tasks,
                (SELECT SUM(budget) FROM projets) AS total_project_budget,
                (SELECT SUM(budget) FROM taches) AS total_task_budget,
                (SELECT SUM(engage) FROM taches) AS total_engaged,
                (SELECT COUNT(*) FROM bailleurs) AS total_bailleurs,
                (SELECT COUNT(*) FROM localites) AS total_localities,
                (SELECT COUNT(*) FROM regions) AS total_regions,
                (SELECT COUNT(*) FROM users) AS total_users
        ");

        return response()->json([
            'title' => 'Dashboard Overview',
            'description' => 'Overall system statistics and KPIs',
            'data' => $data,
            'total' => count($data)
        ]);
    }
}