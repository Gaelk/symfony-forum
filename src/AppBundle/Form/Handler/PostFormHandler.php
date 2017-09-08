<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/09/2017
 * Time: 11:23
 */

namespace AppBundle\Form\Handler;


use AppBundle\Entity\Manager\PostManager;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class PostFormHandler
{

    /**
     * @var Post
     */
    private  $post;

    /**
     * @var string
     */
    private $formclassName;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var PostManager
     */
    private  $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var Form
     */
    private $form;
    /**
     * PostFormHandler constructor.
     * @param Post $post
     * @param string $formclassName
     * @param FormFactory $formFactory
     * @param PostManager $manager
     * @param RequestStack $request
     */
    /**
     * @var UploadableManager
     */
    private $uploadableManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * PostFormHandler constructor.
     * @param Post $post
     * @param string $formclassName
     * @param FormFactory $formFactory
     * @param PostManager $manager
     * @param RequestStack $requestStack
     * @param UploadableManager $uploadableManager
     */
    public function __construct(Post $post, $formclassName, FormFactory $formFactory, PostManager $manager, RequestStack $requestStack, UploadableManager $uploadableManager)
    {
        $this->post = $post;
        $this->formclassName = $formclassName;
        $this->formFactory = $formFactory;
        $this->manager = $manager;
        $this->requestStack = $requestStack;
        $this->uploadableManager = $uploadableManager;

        $this->request= $requestStack->getCurrentRequest();
    }


    public function process(){
        $this->form= $this->formFactory->create(PostType::class, $this->post);
        $this->form->handleRequest($this->request);

        $success=false;

        if($this->form->isSubmitted()&& $this->form->isValid()){
            $success=true;

            //persictance
            if ($this->form->isSubmitted() and $this->form->isValid()){

                if($this->post->getImageFileName() instanceof UploadedFile){
                    $this->uploadableManager->markEntityToUpload($this->post, $this->post->getImageFileName() );
                }

                $this->manager->setPost($this->post)->save();
            }
        }

        return $success;

    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     * @return PostFormHandler
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return Form
     */
    public function getFormView()
    {
        return $this->form->createView();
    }

    /**
     * @param Form $form
     * @return PostFormHandler
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }



}