<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;

class TaskController extends AbstractController {
    /**
     * @Route("/tasks", methods={"GET"}, name="get_tasks")
     * @param Request $request
     * @return Response
     */
    public function getTasks(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Task::class);
        
        $tasks = $repo->findBy(['userId' => $request->getSession()->get('userId')]);
        
        return $this->render(
                    'tasks.html.twig',
                    ['tasks' => $tasks]
            );
    }
    
    /**
     * @Route("/task_add", methods={"POST"}, name="add_task")
     * @param Request $request
     * @return Response
     */
    public function addTask(Request $request)
    {
        $task = new Task($request->getSession()->get('userId'), $request->request->get('taskName'));
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($task);
        $em->flush();
        
        return $this->redirect('/tasks');
    }
    
    
    /**
     * @Route("/task_delete", methods={"POST"}, name="delete_task")
     * @param Request $request
     * @return Response
     */
    public function deleteTask(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Task::class);
        
        $task = $repo->findOneBy([
            'id' => $request->request->get('taskId'),
            'userId' => $request->getSession()->get('userId')
        ]);
        
        if(!empty($task)) {
            $em = $this->getDoctrine()->getManager();
            
            $em->remove($task);
            $em->flush();
        }
        
        return $this->redirect('/tasks');
    }
    
}
