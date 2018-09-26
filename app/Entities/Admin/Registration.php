<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
     protected $fillable = 	[	
    							'id','ProductID','MaxPersons','MinPersons','Description','RegistrationFromDateTime','RegistrationToDateTime',
    							'RegistrationPlaceName','RegistrationPlaceAddress','RegistrationPlaceZipCode','RegistrationPlaceCity',
    							'RegistrationPlaceCountry','InsertedByPersonID','UpdatedByPersonID','Active','LecturerPersonID','IsFull',
    							'stylesheet','SuccessMessage','Title','RegistrationNumber','RegistrationEventStartDateTime',
    							'IsGroup','IsExclusive','IsList','RegistrationParentID','ListMessage','RegistrationRecurringID',
    							'IsListAuto','CodeWord','SmsWaitingListText','SmsMovedFromWaitingList','SmsAutoDeregistered',
    							'EmailMovedFromWaitingList','EmailAutoDeregistered','SmsRegistrationFull','EmailRegistrationFull',
    							'SmsConfirmText','SmsRegisteredText','ShowForm','ShowDateTime','ShortNumber','ConfirmIndividualText',
    							'AutoDeregisteredIndividualText','WaitingListIndividualText','PayType','RegistrationUrl','IncludeVcal',
    							'SendExtraEmail','ShowTitle','ShowDescription','ShowPlace','ShowStatus','SendEmail','EmailInviteText',
    							'EmailInviteIndividualText','ActiveWeb','DeclinedText','DescriptionInternal',
    							'ConfirmIndividualHeaderText','AutoDeregisteredIndividualHeaderText','WaitingListIndividualHeaderText',
    							'EmailInviteIndividualHeaderText','EmailTest','EnableConfirmStatus','EnableDeregisteredStatus',
    							'EnableDeclinedStatus','LanguageID','WebSiteHeader','WebSiteFooter','WebSiteLogoMediaStorageID',
    							'WebSiteBackgroundMediaStorageID','FrontPageTitle','FrontPageDescription','ShowFrontPage',
    							'ShowFrontPageDateTime','ShowFrontPagePlace','ProgramTitle','ProgramDescription','ShowProgram',
    							'ContactTitle','ContactDescription','ShowContact','OptionalTitle','OptionalDescription','ShowOptional',
    							'ShowRegistrationForm','RegistrationFormTitle','Password','ContactEmail','OptionalTabTitle',
    							'ShowFormInFrontend','ConfirmLinkText','EmailInviteLinkText','WaitingListLinkText','IncludeQrCode',
    							'DeregisteredWebText','ShowProduct','ShowPrice','FrontPageTabTitle','ProgramTabTitle',
    							'RegistrationFormTabTitle','ContactTabTitle','InvoiceComment','RegistrationDeadline',
    							'IncludeConfirmUserLink','AllowCourseCoordinator','CourseCoordinatorConfirmTemplate',
    							'CourseCoordinatorConfirmText','CourseCoordinatorIndividualHeaderText','CourseCoordinatorConfirmLinkText',
    							'CertificateTemplate','CertificateText','CertificateLogoMediaStorageID','CertificateImageMediaStorageID',
    							'CreateNewUserOnPaid','RegistrationImageMediaStorageID','Template','InvoiceCompanyID','UrlAlias',
    							'FrontImageMediaStorageID','ProgramImageMediaStorageID','ContactImageMediaStorageID',
    							'OptionalImageMediaStorageID','ShowParticipant','ParticipantTitle','ParticipantTabTitle',
    							'ParticipantDescription','ShowParticipantEmail','ShowParticipantPhone','ParticipantsImageMediaStorageID',
    							'InvitationOnly','ShowInvitationOnly','InvitationOnlyMessage'
    						];

}
