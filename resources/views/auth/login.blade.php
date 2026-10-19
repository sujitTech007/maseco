
@include('Include.header')
<main>
    <section class="login-page">
        <div class="login-wrapper">
            <div class="row g-0">

                <!-- Left: MASECO branding -->
                <div class="col-md-6">
                    <div class="login-brand" data-aos="fade-right">

                        <span class="login-eyebrow">WELCOME BACK TO MASECO</span>

                        <h2 class="section-title-h2 mb-2 text-white">
                            Source Better.
                            <span>Build Smarter.</span>
                            Grow Together.
                        </h2>

                        <p class="login-intro">
                            Log in to your MASECO account and connect with
                            suppliers and manufacturers for quality raw
                            materials and smarter sourcing.
                        </p>

                        <div class="login-benefits">

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa-solid fa-cubes" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Quality Raw Materials</h6>
                                    <p>Discover materials for your business needs.</p>
                                </div>
                            </div>

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa-solid fa-handshake" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Trusted Connections</h6>
                                    <p>Connect with suppliers and manufacturers.</p>
                                </div>
                            </div>

                            <div class="login-benefit">
                                <div class="login-benefit-icon">
                                    <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6>Smarter Sourcing</h6>
                                    <p>Make your sourcing process simpler.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right: Login form -->
                <div class="col-md-6">
                    <div class="login-form-panel" data-aos="fade-left">

                        <div class="login-form-heading">
                            <h1>Login</h1>
                            <p>Log in to access your MASECO account.</p>
                        </div>

                        <form class="verify-gcaptcha login-form"
                              method="POST"
                              action="{{ route('login.submit') }}"
                              id="masecoLoginForm">

                            @csrf

                            <!-- Account type -->
                            <div class="form-group">
                                <label class="login-role-label">Login as:</label>

                                <div class="d-flex login-radio">

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_type"
                                               id="userTypeUser"
                                               value="user"
                                               checked>
                                               
                                        <label class="form-check-label"
                                               for="userTypeUser">User</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_type"
                                               id="userTypeSupplier"
                                               value="supplier">
                                        <label class="form-check-label"
                                               for="userTypeSupplier">Supplier</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="user_type"
                                               id="userTypeManufacturer"
                                               value="manufacturer">
                                        <label class="form-check-label"
                                               for="userTypeManufacturer">Manufacturer</label>
                                    </div>

                                </div>
                            </div>

                            <!-- Phone number -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Phone Number</legend>

                                    <div class="d-flex mobileNumber">
                                          <select id="login_country_code" name="country_code" data-live-search="true" class="selectpicker">
                                        <option data-content='<img src="https://flagcdn.com/16x12/af.png" class="me-1"> +93' value="+93">+93</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/al.png" class="me-1"> +355' value="+355">+355</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/dz.png" class="me-1"> +213' value="+213">+213</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/us.png" class="me-1"> +1' value="+1">+1</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ad.png" class="me-1"> +376' value="+376">+376</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ao.png" class="me-1"> +244' value="+244">+244</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ag.png" class="me-1"> +1-268' value="+1-268">+1-268</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ar.png" class="me-1"> +54 ' value="+54">+54</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/am.png" class="me-1"> +374 ' value="+374">+374</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/aw.png" class="me-1"> +297 ' value="+297">+297</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/au.png" class="me-1"> +61 ' value="+61">+61</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/at.png" class="me-1"> +43 ' value="+43">+43</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/az.png" class="me-1"> +994 ' value="+994">+994</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bh.png" class="me-1"> +973 ' value="+973">+973</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bd.png" class="me-1"> +880 ' value="+880">+880</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bb.png" class="me-1"> +1-246 ' value="+1-246">+1-246</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/by.png" class="me-1"> +375 ' value="+375">+375</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/be.png" class="me-1"> +32 ' value="+32">+32</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bz.png" class="me-1"> +501 ' value="+501">+501</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bj.png" class="me-1"> +229 ' value="+229">+229</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bt.png" class="me-1"> +975 ' value="+975">+975</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bo.png" class="me-1"> +591 ' value="+591">+591</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ba.png" class="me-1"> +387 ' value="+387">+387</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bw.png" class="me-1"> +267 ' value="+267">+267</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/br.png" class="me-1"> +55 ' value="+55">+55</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/io.png" class="me-1"> +246 ' value="+246">+246</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bn.png" class="me-1"> +673 ' value="+673">+673</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bg.png" class="me-1"> +359 ' value="+359">+359</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bf.png" class="me-1"> +226 ' value="+226">+226</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bi.png" class="me-1"> +257 ' value="+257">+257</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kh.png" class="me-1"> +855 ' value="+855">+855</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cm.png" class="me-1"> +237 ' value="+237">+237</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ca.png" class="me-1"> +1 ' value="+1">+1</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cv.png" class="me-1"> +238 ' value="+238">+238</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cf.png" class="me-1"> +236 ' value="+236">+236</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/td.png" class="me-1"> +235 ' value="+235">+235</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cl.png" class="me-1"> +56 ' value="+56">+56</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cn.png" class="me-1"> +86 ' value="+86">+86</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/co.png" class="me-1"> +57 ' value="+57">+57</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/km.png" class="me-1"> +269 ' value="+269">+269</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cg.png" class="me-1"> +242 ' value="+242">+242</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cd.png" class="me-1"> +243 ' value="+243">+243</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ck.png" class="me-1"> +682 ' value="+682">+682</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cr.png" class="me-1"> +506 ' value="+506">+506</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/hr.png" class="me-1"> +385 ' value="+385">+385</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cu.png" class="me-1"> +53 ' value="+53">+53</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cy.png" class="me-1"> +357 ' value="+357">+357</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/cz.png" class="me-1"> +420 ' value="+420">+420</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/dk.png" class="me-1"> +45 ' value="+45">+45</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/dj.png" class="me-1"> +253 ' value="+253">+253</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/dm.png" class="me-1"> +1-767 ' value="+1-767">+1-767</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/do.png" class="me-1"> +1-809 ' value="+1-809">+1-809</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ec.png" class="me-1"> +593 ' value="+593">+593</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/eg.png" class="me-1"> +20 ' value="+20">+20</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sv.png" class="me-1"> +503 ' value="+503">+503</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gq.png" class="me-1"> +240 ' value="+240">+240</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/er.png" class="me-1"> +291 ' value="+291">+291</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ee.png" class="me-1"> +372 ' value="+372">+372</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/et.png" class="me-1"> +251 ' value="+251">+251</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/fj.png" class="me-1"> +679 ' value="+679">+679</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/fi.png" class="me-1"> +358 ' value="+358">+358</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/fr.png" class="me-1"> +33 ' value="+33">+33</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gf.png" class="me-1"> +594 ' value="+594">+594</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pf.png" class="me-1"> +689 ' value="+689">+689</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ga.png" class="me-1"> +241 ' value="+241">+241</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gm.png" class="me-1"> +220 ' value="+220">+220</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ge.png" class="me-1"> +995 ' value="+995">+995</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/de.png" class="me-1"> +49 ' value="+49">+49</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gh.png" class="me-1"> +233 ' value="+233">+233</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gi.png" class="me-1"> +350 ' value="+350">+350</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gr.png" class="me-1"> +30 ' value="+30">+30</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gl.png" class="me-1"> +299 ' value="+299">+299</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gd.png" class="me-1"> +1-473 ' value="+1-473">+1-473</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gp.png" class="me-1"> +590 ' value="+590">+590</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gu.png" class="me-1"> +1-671 ' value="+1-671">+1-671</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gt.png" class="me-1"> +502 ' value="+502">+502</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gn.png" class="me-1"> +224 ' value="+224">+224</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gw.png" class="me-1"> +245 ' value="+245">+245</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gy.png" class="me-1"> +592 ' value="+592">+592</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ht.png" class="me-1"> +509 ' value="+509">+509</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/hn.png" class="me-1"> +504 ' value="+504">+504</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/hk.png" class="me-1"> +852 ' value="+852">+852</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/hu.png" class="me-1"> +36 ' value="+36">+36</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/is.png" class="me-1"> +354 ' value="+354">+354</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/in.png" class="me-1"> +91 ' value="+91" selected>+91</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/id.png" class="me-1"> +62 ' value="+62">+62</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ir.png" class="me-1"> +98 ' value="+98">+98</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/iq.png" class="me-1"> +964 ' value="+964">+964</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ie.png" class="me-1"> +353 ' value="+353">+353</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/il.png" class="me-1"> +972 ' value="+972">+972</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/it.png" class="me-1"> +39 ' value="+39">+39</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/jm.png" class="me-1"> +1-876 ' value="+1-876">+1-876</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/jp.png" class="me-1"> +81 ' value="+81">+81</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/jo.png" class="me-1"> +962 ' value="+962">+962</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kz.png" class="me-1"> +7 ' value="+7">+7</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ke.png" class="me-1"> +254 ' value="+254">+254</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ki.png" class="me-1"> +686 ' value="+686">+686</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kw.png" class="me-1"> +965 ' value="+965">+965</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kg.png" class="me-1"> +996 ' value="+996">+996</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/la.png" class="me-1"> +856 ' value="+856">+856</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lv.png" class="me-1"> +371 ' value="+371">+371</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lb.png" class="me-1"> +961 ' value="+961">+961</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ls.png" class="me-1"> +266 ' value="+266">+266</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lr.png" class="me-1"> +231 ' value="+231">+231</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ly.png" class="me-1"> +218 ' value="+218">+218</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/li.png" class="me-1"> +423 ' value="+423">+423</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lt.png" class="me-1"> +370 ' value="+370">+370</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lu.png" class="me-1"> +352 ' value="+352">+352</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mo.png" class="me-1"> +853 ' value="+853">+853</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mk.png" class="me-1"> +389 ' value="+389">+389</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mg.png" class="me-1"> +261 ' value="+261">+261</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mw.png" class="me-1"> +265 ' value="+265">+265</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/my.png" class="me-1"> +60 ' value="+60">+60</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mv.png" class="me-1"> +960 ' value="+960">+960</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ml.png" class="me-1"> +223 ' value="+223">+223</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mt.png" class="me-1"> +356 ' value="+356">+356</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mh.png" class="me-1"> +692 ' value="+692">+692</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mq.png" class="me-1"> +596 ' value="+596">+596</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mr.png" class="me-1"> +222 ' value="+222">+222</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mu.png" class="me-1"> +230 ' value="+230">+230</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/yt.png" class="me-1"> +262 ' value="+262">+262</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mx.png" class="me-1"> +52 ' value="+52">+52</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/fm.png" class="me-1"> +691 ' value="+691">+691</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/md.png" class="me-1"> +373 ' value="+373">+373</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mc.png" class="me-1"> +377 ' value="+377">+377</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mn.png" class="me-1"> +976 ' value="+976">+976</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/me.png" class="me-1"> +382 ' value="+382">+382</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ms.png" class="me-1"> +1-664 ' value="+1-664">+1-664</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ma.png" class="me-1"> +212 ' value="+212">+212</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mz.png" class="me-1"> +258 ' value="+258">+258</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mm.png" class="me-1"> +95 ' value="+95">+95</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/na.png" class="me-1"> +264 ' value="+264">+264</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/nr.png" class="me-1"> +674 ' value="+674">+674</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/np.png" class="me-1"> +977 ' value="+977">+977</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/nl.png" class="me-1"> +31 ' value="+31">+31</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/nc.png" class="me-1"> +687 ' value="+687">+687</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/nz.png" class="me-1"> +64 ' value="+64">+64</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ni.png" class="me-1"> +505 ' value="+505">+505</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ne.png" class="me-1"> +227 ' value="+227">+227</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ng.png" class="me-1"> +234 ' value="+234">+234</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12.nu.png" class="me-1"> +683 ' value="+683">+683</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/nf.png" class="me-1"> +672 ' value="+672">+672</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kp.png" class="me-1"> +850 ' value="+850">+850</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mp.png" class="me-1"> +1-670 ' value="+1-670">+1-670</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/no.png" class="me-1"> +47 ' value="+47">+47</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/om.png" class="me-1"> +968 ' value="+968">+968</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pk.png" class="me-1"> +92 ' value="+92">+92</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pw.png" class="me-1"> +680 ' value="+680">+680</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ps.png" class="me-1"> +970 ' value="+970">+970</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pa.png" class="me-1"> +507 ' value="+507">+507</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pg.png" class="me-1"> +675 ' value="+675">+675</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/py.png" class="me-1"> +595 ' value="+595">+595</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pe.png" class="me-1"> +51 ' value="+51">+51</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ph.png" class="me-1"> +63 ' value="+63">+63</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pl.png" class="me-1"> +48 ' value="+48">+48</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pt.png" class="me-1"> +351 ' value="+351">+351</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pr.png" class="me-1"> +1-787 ' value="+1-787">+1-787</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/qa.png" class="me-1"> +974 ' value="+974">+974</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ro.png" class="me-1"> +40 ' value="+40">+40</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ru.png" class="me-1"> +7 ' value="+7">+7</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/rw.png" class="me-1"> +250 ' value="+250">+250</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/bl.png" class="me-1"> +590 ' value="+590">+590</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sh.png" class="me-1"> +290 ' value="+290">+290</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kn.png" class="me-1"> +1-869 ' value="+1-869">+1-869</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lc.png" class="me-1"> +1-758 ' value="+1-758">+1-758</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/mf.png" class="me-1"> +590 ' value="+590">+590</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/pn.png" class="me-1"> +508 ' value="+508">+508</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/vc.png" class="me-1"> +1-784 ' value="+1-784">+1-784</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ws.png" class="me-1"> +685 ' value="+685">+685</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sm.png" class="me-1"> +378 ' value="+378">+378</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/st.png" class="me-1"> +239 ' value="+239">+239</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sa.png" class="me-1"> +966 ' value="+966">+966</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sn.png" class="me-1"> +221 ' value="+221">+221</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/rs.png" class="me-1"> +381 ' value="+381">+381</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sc.png" class="me-1"> +248 ' value="+248">+248</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sl.png" class="me-1"> +232 ' value="+232">+232</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sg.png" class="me-1"> +65 ' value="+65">+65</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sk.png" class="me-1"> +421 ' value="+421">+421</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/si.png" class="me-1"> +386 ' value="+386">+386</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sb.png" class="me-1"> +677 ' value="+677">+677</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/so.png" class="me-1"> +252 ' value="+252">+252</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/za.png" class="me-1"> +27 ' value="+27">+27</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/kr.png" class="me-1"> +82 ' value="+82">+82</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ss.png" class="me-1"> +211 ' value="+211">+211</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/es.png" class="me-1"> +34 ' value="+34">+34</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/lk.png" class="me-1"> +94 ' value="+94">+94</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sd.png" class="me-1"> +249 ' value="+249">+249</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sr.png" class="me-1"> +597 ' value="+597">+597</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sj.png" class="me-1"> +47 ' value="+47">+47</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sz.png" class="me-1"> +268 ' value="+268">+268</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/se.png" class="me-1"> +46 ' value="+46">+46</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ch.png" class="me-1"> +41 ' value="+41">+41</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/sy.png" class="me-1"> +963 ' value="+963">+963</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tw.png" class="me-1"> +886 ' value="+886">+886</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tj.png" class="me-1"> +992 ' value="+992">+992</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tz.png" class="me-1"> +255 ' value="+255">+255</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/th.png" class="me-1"> +66 ' value="+66">+66</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tg.png" class="me-1"> +228 ' value="+228">+228</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tk.png" class="me-1"> +690 ' value="+690">+690</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/to.png" class="me-1"> +676 ' value="+676">+676</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tt.png" class="me-1"> +1-868 ' value="+1-868">+1-868</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tn.png" class="me-1"> +216 ' value="+216">+216</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tr.png" class="me-1"> +90 ' value="+90">+90</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tm.png" class="me-1"> +993 ' value="+993">+993</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tc.png" class="me-1"> +1-649 ' value="+1-649">+1-649</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/tv.png" class="me-1"> +688 ' value="+688">+688</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ug.png" class="me-1"> +256 ' value="+256">+256</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ua.png" class="me-1"> +380 ' value="+380">+380</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ae.png" class="me-1"> +971 ' value="+971">+971</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/gb.png" class="me-1"> +44 ' value="+44">+44</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/uy.png" class="me-1"> +598 ' value="+598">+598</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/uz.png" class="me-1"> +998 ' value="+998">+998</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/vu.png" class="me-1"> +678 ' value="+678">+678</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ve.png" class="me-1"> +58 ' value="+58">+58</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/vn.png" class="me-1"> +84 ' value="+84">+84</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/vg.png" class="me-1"> +1-284 ' value="+1-284">+1-284</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/vi.png" class="me-1"> +1-340 ' value="+1-340">+1-340</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/wf.png" class="me-1"> +681 ' value="+681">+681</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/eh.png" class="me-1"> +212 ' value="+212">+212</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/ye.png" class="me-1"> +967 ' value="+967">+967</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/zm.png" class="me-1"> +260 ' value="+260">+260</option>
                                        <option data-content='<img src="https://flagcdn.com/16x12/zw.png" class="me-1"> +263 ' value="+263">+263</option>
                                    </select>
                                    <input class="form-control form--control bg-white" name="phone" type="tel" value="" placeholder="e.g. +1 234 567 8900" required>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <fieldset>
                                    <legend>Password</legend>

                                    <div class="login-password-wrap">
                                        <input
                                            class="form-control"
                                            id="password-field"
                                            name="password"
                                            type="password"
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                            required>


                                        <span
                                            class="fa-solid fa-eye login-password-toggle"
                                            id="password-field"
                                            role="button"
                                            tabindex="0"
                                            aria-label="Show password"
                                            aria-controls="login-password">
                                        </span>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Forgot password -->
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="login-forgot"
                                   href="{{ route('password.forgot') }}">
                                    Forgot password?
                                </a>
                            </div>

                            <!-- Submit -->
                            <div class="form-group mt-4 mb-0">
                                <button class="theme-btn w-100" type="submit">
                                    Login
                                </button>
                            </div>

                            <p class="login-signup">
                                Don't have an account?
                                <a href="{{ route('sign.up') }}">Sign up</a>
                            </p>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

@include('Include.footer')


    


