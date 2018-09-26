<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.registrations.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.registrations.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insertH = array(
            'ProductID'                             => 0,#isset($args['ProductID']) ? $args['ProductID'] : 0,
            'Title'                                 => 0,#isset($args['Title'])     ? $args['Title']     : '',
            'MaxPersons'                            => 0,
            'MinPersons'                            => 0,
            'RegistrationFromDateTime'              => null,#$_lib['date']->add_month( date('Y-m-d'), 1),
            'RegistrationToDateTime'                => null ,#$_lib['date']->add_month( date('Y-m-d'), 1),
            'RegistrationDeadline'                  => null,#$_lib['date']->add_month( date('Y-m-d'), 1),
            'Active'                                => 1,
            'LanguageID'                            => "",#$_lib['auth']->LanguageID,
            'RegistrationParentID'                  => "",#isset($args['RegistrationParentID']) ? (int) $args['RegistrationParentID'] : 0,
            'IsGroup'                               => "",#isset($args['IsGroup']) ? $args['IsGroup'] : 0,
            'LecturerPersonID'                      => "",#$_lib['sess']->get_person('PersonID'),
            'RegistrationRecurringID'               => "",#sha1( uniqid() ),
            'SendEmail'                             => "",#$this->getSender(),
            'EmailTest'                             => "",#$_lib['setup']->get_value('registration.emailtest'),
            'ContactEmail'                          => "",#$this->getSender(),
            'EmailAutoDeregistered'                 => "",#$_lib['setup']->get_value('registration.autoderegistertemplate'),
            'EmailConfirmText'                      => "",#$_lib['setup']->get_value('registration.confirmtemplate'),
            'EmailInviteText'                       => "",#$_lib['setup']->get_value('registration.invitetemplate'),
            'EmailMovedFromWaitingList'             => "",#$_lib['setup']->get_value('registration.movedfromwaitinglisttemplate'),
            'CourseCoordinatorConfirmTemplate'      => "",#$_lib['setup']->get_value('registration.coursecoordinatorconfirmtemplate'),
            'CertificateTemplate'                   => "",#$_lib['setup']->get_value('registration.certificatetemplate'),
            'ListMessage'                           => "",#$_lib['lang']->s('idPlacedOnWaitingList'),
            'SmsAutoDeregistered'                   => "",#$_lib['lang']->s('idSMSDefaultAutoDeregistered'),
            'SmsConfirmText'                        => "",#$_lib['lang']->s('idSMSDefaultConfirm'),
            'SmsDeregisteredText'                   => "",#$_lib['lang']->s('idSMSDefaultDeregistered'),
            'SmsRegisteredText'                     => "",#$_lib['lang']->s('idSMSDefaultRegistered'),
            'SmsRegistrationFull'                   => "",#$_lib['lang']->s('idSMSDefaultFull'),
            'SmsWaitingListText'                    => "",#$_lib['lang']->s('idSMSDefaultWaitingList'),
            'SmsMovedFromWaitingList'               => "",#$_lib['lang']->s('idSmsMovedFromWaitingList'),
            'WaitingListIndividualHeaderText'       => "",#$_lib['lang']->s('idRegistrationMovedFromWaitingList'),
            'AutoDeregisteredIndividualHeaderText'  => "",#$_lib['lang']->s('idSmsAutoDeregistered'),
            'ConfirmIndividualHeaderText'           => "",#$_lib['lang']->s('idMailSubjectRegistrationConfirmation'),
            'EmailInviteIndividualHeaderText'       => "",#$_lib['lang']->s('idInvitation'),
            'CourseCoordinatorIndividualHeaderText' => "",#$_lib['lang']->s('idMailSubjectCourseCoordinatorConfirmati'),
            'DeclinedText'                          => "",#$_lib['lang']->s('idThanksForTheRequest'),
            'SuccessMessage'                        => "",#$_lib['lang']->s('idThanksForTheRegistration'),
            'DeregisteredWebText'                   => "",#$_lib['lang']->s('idDeregisteredRequestText'),
            'FrontPageTitle'                        => "",#$_lib['lang']->s('idFrontPage'),
            'FrontPageTabTitle'                     => "",#$_lib['lang']->s('idFrontPage'),
            'ProgramTitle'                          => "",#$_lib['lang']->s('idProgram'),
            'ProgramTabTitle'                       => "",#$_lib['lang']->s('idProgram'),
            'RegistrationFormTitle'                 => "",#$_lib['lang']->s('idRegistrationConfig'),
            'RegistrationFormTabTitle'              => "",#$_lib['lang']->s('idRegistrationConfig'),
            'ContactTitle'                          => "",#$_lib['lang']->s('idContact'),
            'ContactTabTitle'                       => "",#$_lib['lang']->s('idContact'),
            'OptionalTitle'                         => "",#$_lib['lang']->s('idOptionalPage'),
            'OptionalTabTitle'                      => "",#$_lib['lang']->s('idOptionalPage'),
            'ConfirmLinkText'                       => "",#$_lib['lang']->s('idEditYourRegistration'),
            'EmailInviteLinkText'                   => "",#$_lib['lang']->s('idReadMoreAboutThisActivity'),
            'WaitingListLinkText'                   => ""#$_lib['lang']->s('idConfirmYourRegistrationWithin') .
                                                       #' 24 ' . mb_strtolower($_lib['lang']->s('idHours')) . ' ' .
                                                      ,# mb_strtolower($_lib['lang']->s('idHere')),
            'CourseCoordinatorConfirmLinkText'      => "",#$_lib['lang']->s('idEditYourRegistration'),
            'ParticipantTitle'                      => "",#$_lib['lang']->s('idParticipantPage'),
            'ParticipantTabTitle'                   => ""#$_lib['lang']->s('idParticipantPage')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
