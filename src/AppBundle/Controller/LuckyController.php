<?php
    // src/AppBundle/Controller/LuckyController.php
    namespace AppBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use AppBundle\Entity\Person;

    class LuckyController extends Controller
    {
        /**
         * @Route("/lucky/number")
         */
        public function numberAction()
        {
            $number = mt_rand(0, 100);

            return new Response(
                '<html><body>Lucky number: ' . $number . '</body></html>'
            );
        }


        /**
         * @Route("/person/add")
         */
        public function createPeron() {
            $person = new Person();
            $person->setName("warren");
            $person->setAge(25);
            $person->setDesc("programmer");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();
            return new Response(
                '<html><body>A person has been created.</body></html>'
            );
        }

        /**
         * @Route("/person/get")
         */
        public function getPerson () {
            $product = $this->getDoctrine()->getRepository("AppBundle:Person")->find(2);
            if ($product) {
                return new Response(
                    '<html><body>A person has been found.name is '.$product->getName().' </body></html>'
                );
            } else {
                throw $this->createNotFoundException('No product found for id 1');
            }

        }

        /**
         * @Route("/person/del")
         */
        public function delPerson () {
            $product = $this->getDoctrine()->getRepository("AppBundle:Person")->find(2);
            $this->getDoctrine()->getManager()->remove($product);
            $this->getDoctrine()->getManager()->flush();
            return new Response(
                '<html><body>A person has been deleted.</body></html>'
            );
        }

        /**
         * @Route("/person/mod")
         */
        public function updatePerson () {
            $product = $this->getDoctrine()->getRepository("AppBundle:Person")->find(2);
            $product->setName("hahahah");
            $this->getDoctrine()->getManager()->flush();
            return new Response(
                '<html><body>A person has been updated.</body></html>'
            );
        }
    }

?>