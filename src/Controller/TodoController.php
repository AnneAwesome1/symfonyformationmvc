<?php

namespace App\Controller;

use App\data\Todo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/todo')]


class TodoController extends AbstractController
{

    #[Route('/', name: 'app.todo', methods: "GET")]
    public function index(Request $request): Response
    {
        // on recupere la session en cours
        $session = $request->getSession();

        // on recupere todolist dans la session
        $todolist = $session->get('todolist');

        // si todolist n'existe pas je crée la variable dans la session
        if ($todolist == null) {
            $session->set('todolist', $this->init());
        }

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
            'todolist' => $session->get('todolist')
        ]);
    }

    #[Route('/detail/{id}', name: 'app.todo.detail', methods: "GET")]
    public function detail(Request $request, int $id): Response
    {
        // on recupere la session en cours
        $session = $request->getSession();

        // on recupere todolist dans la session
        $todolist = $session->get('todolist');

        $result = null;
        foreach ($todolist as $todo) {
            if ($todo->id === $id) {
                $result = $todo;
            }
        };

        if ($result == null) {
            $this->addFlash('warning', 'La todo que vous tentez d\'afficher n\'existe pas');
        }
        // dd("result");

        // dd($this->todolist); //dump die bien rafraichir la page
        return $this->render('todo/detail.html.twig', [
            'controller_name' => 'TodoController',
            'todo' => $result
        ]);
    }


    #[Route('/delete/{id}', name: 'app.todo.delete', methods: "GET")]
    public function delete(Request $request, int $id)
    {
        $session = $request->getSession();

        $todolist = $session->get('todolist');

        foreach ($todolist as $key => $todo) {
            if ($todo->id == $id) {
                unset($todolist['$key']);
            }
        }

        $session->set('todolist', $todolist);

        return $this->redirect('/todo');
    }

    private function init(): array
    {
        return  [
            new Todo("Apprendre Symfony", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, obcaecati!"),
            new Todo("Créer un Controller", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, obcaecati!"),
            new Todo("Manipuler les Données", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, obcaecati!")
        ];
    }
}
