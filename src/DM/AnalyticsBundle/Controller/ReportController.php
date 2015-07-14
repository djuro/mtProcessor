<?php

namespace DM\AnalyticsBundle\Controller;

use DM\AnalyticsBundle\Form\Model\Report as FormReport;
use DM\AnalyticsBundle\Form\ReportType;
use DM\AnalyticsBundle\Form\Repository\ReportRepository;
use DM\AnalyticsBundle\Service\Trend\TrendEnumerator;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class ReportController extends Controller
{
    /**
     * @Route("/admin/report/new", name="admin_report_new")
     * @Route("/", name="start")
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

            $em = $this->get('doctrine_mongodb')->getManager();
            $em->persist($report);
            $em->flush();
        }

        return array('form'=>$form->createView());
    }
}
