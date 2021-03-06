<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Entity\User;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="task")
     */
    public function index() 
    {
        $em = $this->getDoctrine()->getManager();
        /*
        $task_repo = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repo->findAll();

        foreach($tasks as $task){
            echo $task->getUser()->getEmail().': '.$task->getTitle()."<br/>";
        } */

        $user_repo = $this->getDoctrine()->getRepository(User::class);
        $users = $user_repo->findAll();
        /** @var User $user */
        foreach ($users as $user) {
            echo "<h1>{$user->getName()} {$user->getSurname()}</h1>";

            $tasks = $user->getTasks();
            // if (!is_null($tasks)) {
                foreach($tasks as $task){
                    echo $task->getTitle()."<br/>";
                }
            // }
        }

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    //testing entities and relations 


    

    
};
