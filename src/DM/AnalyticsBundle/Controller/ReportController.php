<?php

namespace DM\AnalyticsBundle\Controller;

use DM\AnalyticsBundle\Form\Model\Report as FormReport;
use DM\AnalyticsBundle\Form\ReportType;
use DM\AnalyticsBundle\Form\Repository\ReportRepository;
use DM\AnalyticsBundle\Service\TrendStrategy\TrendEnumerator;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use \DateTime;
use \MongoDate;

class ReportController extends Controller
{
    /**
     * @Route("/admin/report/new", name="admin_report_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $formReport = new FormReport();

        $trends = TrendEnumerator::trends();

    	$form = $this->createForm(new ReportType($trends),$formReport);

        $form->handleRequest($request);

        if($form->isValid())
        {
            $formRepository = new ReportRepository();
            $report = $formRepository->store($formReport);
           
            $reportService = $this->get('report_service');
            $reportService->researchForTrend($report);

            return $this->redirect($this->generateUrl('admin_reports'));
        }

        return array('form'=>$form->createView());
    }

    /**
     * @Route("/admin/test", name="admin_test")
     * @Template()
     */

    public function testAction()
    {
        $messageRepository = $this->get('doctrine_mongodb')->getManager()->getRepository('DMConsumerBundle:Message');
        //$messages = $messageRepository->findBy(array('currencyFrom'=>'EUR','currencyTo'=>'GBP'));

        $qb = $messageRepository->createQueryBuilder('DMConsumerBundle:Message')
        ->field('currencyFrom')->equals('EUR')
        ->field('currencyTo')->equals('GBP');
        //->getQuery()
        //->execute();

        $query = $qb->getQuery();
        
$messages = $query->execute();

foreach($messages as $message)
{
      d($message); 
}

exit;

        //$timePlaced = strtotime("24-JAN-15 10:27:44");
$start = new MongoDate(strtotime("24-JAN-15 10:27:44"));

dd($start);
        //$dateTime = new DateTime($timePlaced);
        //dd($dateTime);
    }
}
