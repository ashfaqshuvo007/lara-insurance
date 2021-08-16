@extends('fontend.layouts.head-master')
@section('title','MySIg by Fidentia | Login')
@section('content')
    @include('fontend.layout-index.layout-index-header') 
    <section>
        <div class="hero-immg">
            <a href="{{route('frontend_index')}}"><img src="{{URL::asset('frontend/images/Terms-of-use-bg.png')}}" class="hero-image"></a>
            <h4 class="text-center text-white privacy-text-heading text-heading1">TERMS OF USE</h4>
            <div class="sub-text text-center">
                <a href="#" class="hero_menu_home_link">Home</a>
                <a href="#" class="hero_menu_why_choose_us"><i class="fa fa-circle dot-icon1 dot-icon1 mr-2"></i> Terms of Use</a>  
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-2">
                    <p class="privacy_policy_headtag"><i>By accessing this website you will by your consent to the following terms and conditions of use without any reservation. Do not access<br> or use access this website if you are unwilling or unable to be bound by the same.</i></p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">This privacy policy (hereinfter referred to as the <b>"Privacy Policy"</b>), along with the Terms and Condition of Use and Disclaimer shall<br> govern your access to and use of the <b>www.MySig.al</b> website (hereinfter referred to as the <b>"Website"</b>).</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">By accessing or using the website, you agree to the provisions of privacu and policy,thus concluding a legally binding contract with the propreators of<br> <b>www.mysig.al, M/s FIdentia Broker Sha</b>, a company incoperated under the companies Act 1956 having its registered office at</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">If you have any questions or concerns about this privacy policy, you can contact us at www.MySig.al/contact or care@MySig.al</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text">MySig.al, a website of an authorised insurance broker shall be under no liability whatsoever in respect of any loss or damage arising directly or<br> indirectly out of the decline of authorization with regard to any transaction, conducted from the account of a user/cardholder having exceeded the<br> preset limit mutually agreed to by MySig.al with the acquiring Bank from time to time.</p>
                </div>
                <div class="col-12 mt-2">
                    <h4 class="head">Limitation of liability</h4>
                    <p class="privacy-text">The Website contains content of a general nature and should not be treated as comprehensive. MySig.al has taken responsible care and efforts to collect and<br> provide information on various insurance product as available in the market and does not make any warranty or representation and assumes no<br> responsibility or liability whatsoever in connection with the accuracy, completeness, applicability, suitability, functionality, or operation of the content on the<br> website or any other website which may be hyperlinked to the website. No damages or compensation can be claimed for any direct or indirect loss caused<br> to a user, including but not limited to any viruses transmitted from internet services or securing information or data provided in the website.</p>
                    <p class="privacy-text">The Website may from time to time include links to external websites like third parties, Insurance Companies websites, third party Payment gateways, etc..<br> MySig.al has included links to these websites to provide you with access to information and services that you may find useful or interesting. MySig.al is not<br> responsible for the content of these links/ website or for anything provided by them. The links/ websites so provided on the Website by MySig.al are not<br> endorsed by MySig.al. Any opinions, advice, statements, services, offers, or other information or content expressed or made available by third parties,<br> including information providers, members or any other user of the Website, are those of the respective parties and not necessarily those of MySig.al.</p>
                    <p class="privacy-text">MySig.al provides the content on the Website on an "AS IS" "WHEN AVAILABLE" basis without warranty of any kind, express or implied, including but not<br> limited to any implied warranty of merchantability or fitness for a particular purpose or non- infringement.</p>
                    <p class="privacy-text">MySig.al expressly disclaims any liability, whether in contract, tort, strict liability or otherwise, for any direct, indirect, incidental, consequential, punitive or<br> special damages arising out of or in any way connected with your access or use or inability to access or use the Website or reliance on its content, including<br> but not limited to any loss of profits, exemplary or special damages, loss sales, loss of revenue, loss of goodwill, loss of bargain, loss of opportunity, loss of or<br> waste of management or other staff time.</p>
                    <p class="privacy-text">Through this Website, MySig.al will provide intermediary services such as timely 'premium due' reminders/ alerts to users/ policy holders by SMS, mails or<br> post. MySig.al shall endeavour to ensure, but does not warrant that the intermediary services so provided will be uninterrupted and/or error free, that defects<br> will be corrected, or that the site/ server that make it available are free of viruses or other harmful components, or that the said reminders/ alerts are free of<br> technical inaccuracies and typographical errors.</p>
                </div>
                <div class="col-12 mt-2">
                    <p class="privacy-text"><b><i>This limitation of liability includs, but is not limited to, the transformations of any viruses which may infecte a user's equipment, use of cookies, failure<br> of machanical or electronic equipment or comunication lines, failure of performance of the Domain/ Server/ Url/ Browser/ Software/ Secure socket<br> layer/ Payment gatway service providers/ Third parties, Insurance companies / Reminders/ Alerts, Interuption, Defect, Delay in Transmission,<br> Computer Viruses or other harmfull components, or line or system failure, Unauthorized access, Problems faced with regard to insurance PDF policy<br> not opening/ Not received by electronic mode or by courier, Issues faced with regard to hackers, or any force Majeure, Regardless of MySig.al's<br> Knowledge there of. MySig.al Cannot and does not guarantee countinuous, Unenterepted or secure access to the site.</i></b> </p>
                </div>
                <div class="col-12 mt-2">
                    <h4>RESERVATION OF RIGHTS</h4>
                    <p class="privacy-text"> MySig.al reserve the right to change, modify, add to, or remove portions of these Terms at any time, without any notice to the user, and the user shall be<br> bound by the modified Terms as on the date and time of browsing. The user is advised therefore to periodically visit this page to review the current<br> Terms to which he/she is bound. </p>
                    <p class="privacy-text">MySig.al prohibits caching the Website, unauthorized hypertext links to the Website, and the framing of any content available on the Website. MySig.al<br> reserves the right to disable any unauthorized links or frames and specifically disclaims any responsibility for the content of any other internet website<br> linked to the Website. Other internet websites which are linked to the Website have their own terms and conditions of use, privacy policies and<br> disclaimers and the user shall abide by them.</p>
                </div>
                <div class="col-12 mt-2">
                    <h4>RESTRICTIONS ON USE OF WEBSITE CONTENT </h4>
                    <p class="privacy-text">The Website MySig.al is an initiative of FIDENTIA SHA INSURANE BROKER. Except as otherwise expressly permitted by FIDENTIA SHA, messages displayed<br> on the Website are for the user's use only. It is understood and agreed by the user that after accessing information from the Website the user shall not<br> distribute, modify, transmit, reuse, report or use the content including the text, images, audio and video content without FIDENTIA SHA's prior obtained<br> written permission. By using the content available on the Website no controversial comparison should be made against any insurer, quoting one insurer<br> against the other.</p>
                    <p class="privacy-text"> Downloading a claim form does not mean that the concerned insurance company will automatically accept the liability towards such claim. Acceptance of<br> a claim or proposal is solely at the discretion of the concerned insurance company, in accordance with their terms and conditions. FIDENTIA SHA is only a<br> platform for making the information/ content available in a single place, i.e. the Website, for the convenience of the user.</p>
                </div>
                <div class="col-12 mt-2">
                    <h4>NO DUTY TO UPDATE </h4>
                    <p class="privacy-text">All content provided by MySig.al on the Website is updated as on the date mentioned hereinabove, and no claim will be entertained which states that any<br> part of the content on the Website is outdated. If, in the opinion of any user, any content contained therein is not up to date, MySig.al will not<br> assume any responsibility for the same.</p>
                </div>
                <div class="col-12 mt-2">
                    <h4>TRADEMARK AND COPYRIGHT </h4>
                    <p class="privacy-text">The 'MySig.al' name and logotype are registered trademarks of FIDENTIA SHA. All rights reserved.<br> All content comprised in the Website is protected under the Indian Copyright Act 1957, and is the property of their respective owners, with all rights reserved.<br> Nothing contained on the Website should be construed as granting, by implication, estoppel, or otherwise, any license or right to use any trademark/<br> copyright displayed on the Website. The user is prohibited from copying, modifying, displaying, distributing, transmitting, redelivering, publishing, selling,<br> licensing, creating derivative works or using any content from the Website for any purpose whatsoever, without the prior written approval of FIDENTIA SHA.</p>
                </div>
                <div class="col-12 mt-2">
                    <h4>JURISDICTION, SEVERABILITY, ASSIGNMENT</h4>
                    <p class="privacy-text"> MySig.al makes no representation that content provided on the Website is appropriate or available for use in any location unless otherwise expressly set<br> forth. A user who chooses to access the Website should do so on his/her own initiative and is responsible for compliance with local laws. </p>
                    <p class="privacy-text">These Terms shall be governed by and construed in accordance with the laws of India and the applicable laws in the State of Tamil Nadu, and any action<br> arising out of these Terms shall be litigated in, and only in, the courts located in Chennai, India, and the user agrees to submit to the exclusive<br> jurisdiction of these courts. </p>
                    <p class="privacy-text">In the event that any provision of these Terms is held to be unenforceable, the validity or enforceability of the remaining provisions will not be affected, and<br> the unenforceable provision will be replaced with an enforceable provision that comes close to the intention underlying the unenforceable provision. </p>
                    <p class="privacy-text">These Terms form the entire understanding between the user and MySig.al and supersedes all previous agreements, understandings and representations<br> relating to the subject matter. MySig.al may delay enforcing its rights under these Terms without losing them. </p>
                    <p class="privacy-text">The user agrees that MySig.al may sub-contract the performance of any of its obligations or may assign these Terms or any of its rights or obligations<br> without giving the user notice of the same.</p>
                </div>
                <div class="col-12 mt-2">
                    <h4>ONLINE PAYMENT </h4>
                    <p class="privacy-text">In order to make an online payment of an Insurance Premium the user will be re-directed to a third party site (referred to as the "Payment Gateway"). By<br> accepting to make payment online, it is implied that the user agrees to the terms and conditions of the Payment Gateway/ Net Banking System/ Credit<br> Card Company or the respective entities. The accuracy or completeness of the content on the Payment Gateway or the reliability of any advice, opinion,<br> statement or other information displayed or distributed through the Payment Gateway, is not warranted by MySig.al and shall be construed to be set forth<br> by the third party site owner.</p>
                    <p class="privacy-text"> MySig.al and/or FIDENTIA SHA and its affiliates, subsidiaries, employees, officers, directors and agents, expressly disclaim any liability for any deficiency in<br> the services of the Payment Gateway's service provider, failure or disruption of the site of the Payment Gateway's service provider, or resulting from the act<br> or omission of any other party involved in making the Payment Gateway's site or the data contained therein available to the user, or from any other cause<br> relating to the user's access to, inability to access, or use of the Payment Gateway's site or these materials in accordance thereto, MySig.al and/or FIDENTIA<br> SHA and all its related parties described hereinabove stand indemnified from all proceedings or matters arising thereto.</p>
                    <p class="privacy-text"> When conducting a payment transaction via the Website, MySig.al will send/ display a transaction id to the user, and the user should cite the same in all<br> future communications with reference to the said payment transaction. The online insurance policy of the user will be generated only after successful<br> payment acknowledgement is received from the Payment Gateway. Please note that as per Section 64VB of the Insurance Act 1938, the insurance risk<br> cover will commence only after the payment towards the premium is received by the third party Insurance Company, and a receipt for the same is<br> obtained by the user. In respect of failed payment transactions, no online insurance policies shall be issued to the user. MySig.al shall not be responsible for<br> non-delivery of the online insurance policy if the user had provided wrong e-mail address.</p>
                </div>
                <div class="col-12 mt-2">
                <h4>CANCELLATION OF POLICY </h4>
                <p class="privacy-text">If a policy holder wishes to cancel an insurance policy, the refund of premium will be on 'Short Period Basis' as per the terms and conditions of the<br> concerned insurance company and Insurance Act. No refund will be permitted under Third party Insurance.</p>
                </div>
                <div class="col-12 mt-2">
                <h4>WARNING</h4>
                    <p class="privacy-text"> Unauthorized access to secured databases or circumvention of security measures on the Website is violation of central and state laws.</p>
            </div>
            <div class="col-12 mt-2">
                <h4>SUSPENSION AND TERMINATION OF THE WEBSITE</h4>
                <p class="privacy-text"> FIDENTIA SHA may suspend or terminate the operation of the MySig.al Website at any time, for any reason whatsoever, without providing prior notice<br> of the same to the user.</p>
            </div>
            <div class="col-12 mt-2">
                <h4>USER'S REPRESENTATIONS AND WARRANTIES</h4>
                <p class="privacy-text"> <b>By accessing or using the Website, the user represents, warrants and covenants that he/she:</b></p>
                <p class="privacy-text"><span>(i)</span> is at least 18 (eighteen) years of age;</p>
                <p class="privacy-text"><span>(ii)</span> shall not use any rights granted hereunder for any unlawful purpose; and</p>
                <p class="privacy-text"><span>(iii)</span> shall use the Website only as set forth in these Terms.</p>
            </div>
            <div class="col-12 mt-2">
                <h4>INDEMNITIES</h4>
                <p class="privacy-text"> By using the Website, you, as the user, agree to indemnify and defend MySig.al and its parent company, subsidiaries, affiliates, directors, officers, consultants,<br> and employees and hold them harmless from any and all claims and expenses, including attorney's fees, arising from your misuse of the Website.</p>
            </div>
            

            </div>
        </div>
    </section>
    <section class="reminder_section mt-5">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-6 reminder-card">
                <h5 class="reminder_heading">SET AN INSURANCE<br><span class="why_choose_us_Section_span">POLICY
                    REMINDER</span></h5>
                <p>We are also authorized to do insurance claim consultancy<br>
                , Risk Inspection and a gap analysis report for our<br>
                clients. A broker represents a policy holder and not<br>
                the insurance company</p>
            </div>
            <div class="col-12 col-md-6">
                <div class="card reminder-card">
                <div class="card-body">
                    <form>
                    <div class="container">
                        <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                            <input type="text" class="card-input form-control" placeholder="Full Name">
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <input type="text" class="card-input form-control" placeholder="Mobile Number">
                        </div>
                        <div class="col-md-6 col-12 mb-2" style="padding-bottom: 10px;">
                            <input type="text" class="card-input form-control" placeholder="Email Address">
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <input type="text" class="card-input form-control" placeholder="Due Date(DD/MM/YY">
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div class=" form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control card-input signup_input_Select pr-5">
                                <option _ngcontent-fbk-c5="" value="other">Insurance Type</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                            <select _ngcontent-fbk-c5=""
                                class="credential__select form-control card-input signup_input_Select pr-5">
                                <option _ngcontent-fbk-c5="" value="other">Insurance Produt</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <button class="btn btn-warning btn-block text-white"
                            style="background-color: orange; font-size: 12px; font-weight: 600; padding: 0.575rem .75rem;">SUBMIT</button>
                        </div>
                        </div>
                    </div>
                    </form>

                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    @include('fontend.layouts.head-footer')
@endsection