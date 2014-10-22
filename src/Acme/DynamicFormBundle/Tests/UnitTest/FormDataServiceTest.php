<?php
namespace Acme\Tests\UnitTest;

require_once __DIR__.'/../../../../../app/AppKernel.php';


class FormDataServiceTest extends \PHPUnit_Framework_TestCase
{


    private $formDataService;
    private $testForm1;
    private $doctrine;

    protected static $kernel;
    protected static $container;



    public static function setUpBeforeClass()
    {
        self::$kernel = new \AppKernel('dev', true);
        self::$kernel->boot();

        self::$container = self::$kernel->getContainer();
    }

    public function get($serviceId)
    {
        return self::$kernel->getContainer()->get($serviceId);
    }

    function setUp()
    {
        $this->doctrine=$this->get("doctrine");
        $this->formDataService = new \Acme\DynamicFormBundle\Services\FormData\FormDataService($this->doctrine);
        $this->testForm1=$this->get("repo.form")->getFormById(1);


    }

    function tearDown()
    {


    }

//
//    function testCreateData()
//    {
//        $f1=new \stdClass();
//        $f1->name="field1";
//        $f1->type="integer";
//
//        $f2=new \stdClass();
//        $f2->name="field2";
//        $f2->type="string";
//
//        $f3=new \stdClass();
//        $f3->name="field3";
//        $f3->type="string";
//
//        $res=$this->formDataService->createFormDataTable($this->testForm1,json_encode(
//            array(
//                $f1,$f2,$f3
//            )
//        )
//        );
//    }

    function testGetData()
    {
        $res=$this->formDataService->getFormDataById(1);
        var_dump($res);

    }
}
 