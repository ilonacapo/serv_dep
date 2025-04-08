<?php

namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'project_list')]
    public function index(ProjectService $projectService): Response
    {
        $projects = $projectService->getProjects();
        return $this->render('project/index.html.twig', ['projects' => $projects]);
    }

    #[Route('/projects/{name}/deploy', name: 'project_deploy')]
    public function deploy(string $name, ProjectService $projectService): Response
    {
        $projects = $projectService->getProjects();
        $project = array_filter($projects, fn($p) => $p['name'] === $name);

        if (!$project) {
            throw $this->createNotFoundException("Projet introuvable.");
        }

        $project = array_values($project)[0];
        shell_exec('cd ' . escapeshellarg($project['deploy_path']) . ' && git pull');

        $this->addFlash('success', "Déploiement de {$project['name']} réussi !");
        return $this->redirectToRoute('project_list');
    }
}
