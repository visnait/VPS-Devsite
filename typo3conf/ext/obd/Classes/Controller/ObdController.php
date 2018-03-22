<?php
namespace DRAKE\Obd\Controller;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Obd controller
 */
class ObdController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * piVars
     */
    protected $piVars;

    /**
     * cObj
     *
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected $cObj = NULL;

    /**
     * obdRepository
     *
     * @var \DRAKE\Obd\Domain\Repository\ObdRepository
     * @inject
     */
    protected $obdRepository = NULL;

    /**
     * Persistence Manager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * initializeAction
     *
     * @return void
     */
    public function initializeAction() {
        
        $this->cObj = $this->configurationManager->getContentObject();
        $this->piVars = $this->request->getArguments();
        $this->piVars['page'] = intval($this->piVars['page']);

        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
        $querySettings->setRespectSysLanguage(TRUE);
        $querySettings->setRespectStoragePage(FALSE);

        $this->obdRepository->setDefaultQuerySettings($querySettings);
        $orderings = [
            'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
        ];
        $this->obdRepository->setDefaultOrderings($orderings);

    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {

        $newObd = $this->objectManager->get(\DRAKE\Obd\Domain\Model\Obd::class);
        $this->view->assign('newOdb', $newObd);
        $this->persistenceManager->persistAll();

        //$codes = $this->obdRepository->findAll();
        $codes = $this->obdRepository->findSome(0,10);
        $this->view->assign('codes', $codes);
        $this->view->assign('total', $this->obdRepository->countAll());

    }


    /**
    * action add
    *
    * @param \DRAKE\Obd\Domain\Model\Obd $newObd
    * @return void
    */
    public function addAction(\DRAKE\Obd\Domain\Model\Obd $newObd)
    {
        $this->obdRepository->add($newObd);
        $this->redirect('list');
    }

}
