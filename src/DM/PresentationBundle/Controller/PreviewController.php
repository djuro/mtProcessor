<?php

namespace DM\PresentationBundle\Controller;

use DM\AnalyticsBundle\Form\Repository\ReportRepository;
use DM\AnalyticsBundle\Service\TrendStrategy\TrendEnumerator;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;

use \DateTime;

class PreviewController extends Controller
{
    /**
     * @Route("/admin/message/list", name="admin_message_list")
     * @Template()
     */
    public function messageListAction(Request $request)
    {
        $page = $request->query->get('page');

        if(empty($page))
            $page = 1;

        $documentManager = $this->get('doctrine_mongodb')->getManager();

        $queryBuilder = $documentManager->createQueryBuilder('DMConsumerBundle:Message')
                                        ->sort('timePlaced', 'desc');

        $adapter = new DoctrineODMMongoDBAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(50);
        $pagerfanta->setCurrentPage($page);

        return array(
            'messages' => $pagerfanta
            );
    }

    /**
     * @Route("/admin/report/list", name="admin_report_list")
     * @Template()
     */
    public function reportListAction(Request $request)
    {
        $page = $request->query->get('page');

        if(empty($page))
            $page = 1;

        $documentManager = $this->get('doctrine_mongodb')->getManager();

        $queryBuilder = $documentManager->createQueryBuilder('DMAnalyticsBundle:Report')
                                        ->sort('createdAt', 'desc');

        $adapter = new DoctrineODMMongoDBAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(50);
        $pagerfanta->setCurrentPage($page);

foreach($pagerfanta as $p)
{
    d($p);
}
exit;
        return array(
            'reports' => $pagerfanta,
            'trendLabels' => TrendEnumerator::trends()
            );
    }

    /**
     * @Route("/")
     * @Template()
     */
    public function homeAction()
    {
echo 7563845414437172634;
exit;
    }
    
}
