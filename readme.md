# twitter.com clone
## Technologies / Stack
* Laravel Framework
* MongoDB
* HAProxy
* Nginx

## BenchMark
![BenchMark](benchmark.png)

## API
<html>
   <head>
      <meta content="text/html; charset=UTF-8" http-equiv="content-type">
   </head>
   <body class="c22 c30">
      <p class="c18">
         <span class="c1 c22"></span>
      </p>
      <p class="c18">
         <span class="c1"></span>
      </p>
      <a id="t.b997fe51cb72944b3e3fe7d5fc0a6160124a696f"></a>
      <a id="t.1"></a>
      <table class="c32">
         <tbody>
            <tr class="c8">
               <td class="c17" colspan="1" rowspan="1">
                  <p class="c15 c21">
                     <span class="c13 c9">Route</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="1">
                  <p class="c15 c21">
                     <span class="c9 c13">Method</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="1">
                  <p class="c15 c21">
                     <span class="c13 c9">Request Params</span>
                  </p>
                  <p class="c15 c21">
                     <span class="c1">POST parameters are JSON (application/json)</span>
                  </p>
               </td>
               <td class="c19" colspan="1" rowspan="1">
                  <p class="c15 c21">
                     <span class="c13 c9">Description</span>
                  </p>
                  <p class="c15 c21">
                     <span class="c1">All return types are JSON</span>
                  </p>
               </td>
            </tr>
            <tr class="c34">
               <td class="c17 c22" colspan="1" rowspan="1">
                  <p class="c15 c21">
                     <span class="c1">/adduser</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="1">
                  <p class="c15 c21">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_t75zkrbghosd-0 start">
                     <li class="c3 c21">
                        <span class="c9">username</span>
                     </li>
                     <li class="c3 c21">
                        <span class="c9">email</span>
                     </li>
                     <li class="c3 c21">
                        <span class="c13 c9">password</span>
                     </li>
                  </ul>
                  <p class="c7 c21">
                     <span class="c1"></span>
                  </p>
               </td>
               <td class="c19" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_fe7suoya5wtb-0 start">
                     <li class="c3 c21">
                        <span class="c1">Register new user account</span>
                     </li>
                     <li class="c3 c21">
                        <span class="c1">Username and email must be unique</span>
                     </li>
                     <li class="c3 c21">
                        <span class="c1">Should send email with verification key</span>
                     </li>
                  </ul>
                  <p class="c7 c21">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_fe7suoya5wtb-0">
                     <li class="c3 c21">
                        <span class="c23">Returns:</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_fe7suoya5wtb-1 start">
                     <li class="c6 c21">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6 c21">
                        <span class="c9">error:</span>
                        <span class="c1">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
                  <p class="c7 c21">
                     <span class="c1"></span>
                  </p>
               </td>
            </tr>
            <tr class="c8">
               <td class="c17 c22" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/login</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_t75zkrbghosd-0">
                     <li class="c3">
                        <span class="c9">username</span>
                     </li>
                     <li class="c3">
                        <span class="c13 c9">password</span>
                     </li>
                  </ul>
               </td>
               <td class="c19" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_la936x4rw1qp-0 start">
                     <li class="c3">
                        <span class="c1">Login to account</span>
                     </li>
                     <li class="c3">
                        <span class="c1">Sets session cookie</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_l789lne2pxx2-0 start">
                     <li class="c3">
                        <span class="c1">Returns:</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_l789lne2pxx2-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error:</span>
                        <span class="c23">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c17 c22" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/logout</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="1">
                  <p class="c7 c33">
                     <span class="c13 c9"></span>
                  </p>
               </td>
               <td class="c19" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_3c985d66kqiq-0 start">
                     <li class="c3">
                        <span class="c1">Logout of account</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_n9ij0kz5ap2c-0 start">
                     <li class="c3">
                        <span class="c1">Returns:</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_n9ij0kz5ap2c-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error:</span>
                        <span class="c1">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c36">
               <td class="c17 c22" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">/verify</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="2">
                  <ul class="c4 lst-kix_4edbbzn4xtfb-0 start">
                     <li class="c3">
                        <span class="c9">email</span>
                     </li>
                     <li class="c3">
                        <span class="c9">key:</span>
                        <span class="c1">&nbsp;verification key</span>
                     </li>
                  </ul>
               </td>
               <td class="c19" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_717uedvafibk-0 start">
                     <li class="c3">
                        <span class="c1">Verifies account</span>
                     </li>
                     <li class="c3">
                        <span class="c1">Account cannot be used until account is verified</span>
                     </li>
                     <li class="c3">
                        <span class="c23">Email should include the text: </span>
                        <span class="c23 c27">validation key</span>
                        <span class="c25 c23">: </span>
                        <span class="c23 c27">&lt;</span>
                        <span class="c23 c27 c38">key_goes_here</span>
                        <span class="c23 c27">&gt;</span>
                        <span class="c23 c25">
                        <br>
                        </span>
                        <span class="c23 c27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="c1">(including &lt; and &gt; characters)</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_l789lne2pxx2-0">
                     <li class="c3">
                        <span class="c1">Returns:</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_l789lne2pxx2-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error:</span>
                        <span class="c1">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
               </td>
            </tr>
            <tr class="c24">
               <td class="c19 c26" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_s8pn5pshdm8-0 start">
                     <li class="c3">
                        <span class="c1">Add a backdoor key &nbsp;&ldquo;abracadabra&rdquo; for validation</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c17 c22" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">/additem</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_yxhtog22ve1u-0 start">
                     <li class="c3">
                        <span class="c9">content</span>
                        <span class="c1">: body of item</span>
                     </li>
                     <li class="c3">
                        <span class="c9">childType</span>
                        <span class="c23">: string (&ldquo;retweet&rdquo; or &ldquo;reply&rdquo;)</span>
                        <span class="c1">, null if this is not a child item. </span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yxhtog22ve1u-1 start">
                     <li class="c6">
                        <span class="c1">Optional</span>
                     </li>
                  </ul>
               </td>
               <td class="c19" colspan="1" rowspan="2">
                  <ul class="c4 lst-kix_955l3z2h69sp-0 start">
                     <li class="c3">
                        <span class="c1">Post a new item</span>
                     </li>
                     <li class="c3">
                        <span class="c1">Only allowed if logged in</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_955l3z2h69sp-0">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_955l3z2h69sp-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">id: </span>
                        <span class="c1">unique item ID string (if OK)</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error:</span>
                        <span class="c1">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c5" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_yxhtog22ve1u-0">
                     <li class="c3">
                        <span class="c9">parent</span>
                        <span class="c1">: item ID</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yxhtog22ve1u-1 start">
                     <li class="c6">
                        <span class="c1">ID of the original item being responded to</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Optional</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yxhtog22ve1u-0">
                     <li class="c3">
                        <span class="c9">media</span>
                        <span class="c1">: array of media IDs</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yxhtog22ve1u-1 start">
                     <li class="c6">
                        <span class="c1">Optional</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c17 c22" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">/item/&lt;id&gt;</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">GET</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="2">
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
               </td>
               <td class="c19" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_9jpmcrud2bco-0 start">
                     <li class="c3">
                        <span class="c1">Get contents of a single &lt;id&gt; item</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_23ps9fvejw4-0 start">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_23ps9fvejw4-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c13 c9">item: {</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_23ps9fvejw4-2 start">
                     <li class="c10">
                        <span class="c9">id: </span>
                        <span class="c1">item ID string</span>
                     </li>
                     <li class="c10">
                        <span class="c9">username: </span>
                        <span class="c1">username who sent item</span>
                     </li>
                     <li class="c10">
                        <span class="c9">p</span>
                        <span class="c9">roperty: </span>
                        <span class="c1">{</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_23ps9fvejw4-3 start">
                     <li class="c15 c37">
                        <span class="c9">likes:</span>
                        <span class="c1">&nbsp;number</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_23ps9fvejw4-2">
                     <li class="c10">
                        <span class="c23">}</span>
                     </li>
                     <li class="c10">
                        <span class="c9">retweeted</span>
                        <span class="c23">: number</span>
                     </li>
                     <li class="c10">
                        <span class="c9">content: </span>
                        <span class="c1">body of item, (original content if this item is a retweet)</span>
                     </li>
                     <li class="c10">
                        <span class="c9">timestamp</span>
                        <span class="c23">: timestamp, represented as </span>
                        <span class="c28 c23">
                        <a class="c35" href="https://www.google.com/url?q=https://en.wikipedia.org/wiki/Unix_time&amp;sa=D&amp;ust=1530134791726000">Unix time</a>
                        </span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_23ps9fvejw4-1">
                     <li class="c6">
                        <span class="c9">}</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error:</span>
                        <span class="c1">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c19 c26" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_hesddpxcj886-0 start">
                     <li class="c6">
                        <span class="c9">item: </span>
                        <span class="c1">{</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_hesddpxcj886-1 start">
                     <li class="c10">
                        <span class="c1">&hellip;</span>
                     </li>
                     <li class="c10">
                        <span class="c9">childType:</span>
                        <span class="c23">&nbsp;string (&ldquo;retweet&rdquo; or &ldquo;reply&rdquo;), null if this is not a child item.
                        </span>
                     </li>
                     <li class="c10">
                        <span class="c9 c26">parent:</span>
                        <span class="c20">&nbsp;parent ID (can be empty or left out)</span>
                     </li>
                     <li class="c10">
                        <span class="c9">media:</span>
                        <span class="c1">&nbsp;array of IDs of associated media files</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_hesddpxcj886-0">
                     <li class="c6">
                        <span class="c1">}</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c16 c17" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">/item/&lt;id&gt;</span>
                  </p>
               </td>
               <td class="c2 c16" colspan="1" rowspan="2">
                  <p class="c15">
                     <span class="c1">DELETE</span>
                  </p>
               </td>
               <td class="c12 c16" colspan="1" rowspan="2">
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
               </td>
               <td class="c19 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_8ati7uows3wh-0 start">
                     <li class="c3">
                        <span class="c1">Delete item &lt;id&gt;</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_tqxbykkr3rzz-0 start">
                     <li class="c3">
                        <span class="c1">Result in HTTP status code</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_tqxbykkr3rzz-1 start">
                     <li class="c6">
                        <span class="c1">200 OK on Success anything other than 2xx on Failure</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c19 c26" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_8ati7uows3wh-0">
                     <li class="c3">
                        <span class="c23">Delete associated</span>
                        <span class="c23">&nbsp;media file(s) too</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c17 c22" colspan="1" rowspan="3">
                  <p class="c15">
                     <span class="c1">/search</span>
                  </p>
               </td>
               <td class="c2" colspan="1" rowspan="3">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_z51oigauf6pi-0 start">
                     <li class="c3">
                        <span class="c9">timestamp</span>
                        <span class="c1">: search items from this time and earlier</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_z51oigauf6pi-1 start">
                     <li class="c6">
                        <span class="c23">Represented as </span>
                        <span class="c23 c28">
                        <a class="c35" href="https://www.google.com/url?q=https://en.wikipedia.org/wiki/Unix_time&amp;sa=D&amp;ust=1530134791733000">Unix time</a>
                        </span>
                        <span class="c1">&nbsp;in seconds</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Integer, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: Current time</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_z51oigauf6pi-0">
                     <li class="c3">
                        <span class="c9">limit</span>
                        <span class="c1">: number of items to return</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_z51oigauf6pi-1 start">
                     <li class="c6">
                        <span class="c1">Integer, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: 25</span>
                     </li>
                     <li class="c6">
                        <span class="c23">Max: 100</span>
                     </li>
                  </ul>
               </td>
               <td class="c19" colspan="1" rowspan="3">
                  <ul class="c4 lst-kix_rndv10n80l3i-0 start">
                     <li class="c3">
                        <span class="c1">Gets a list of the latest &lt;limit&gt; number of items prior to (and including) the provided
                        &lt;timestamp&gt;</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_xzs42qfuouih-0 start">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_xzs42qfuouih-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">items: </span>
                        <span class="c1">Array of item objects (see /item/:id)</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error:</span>
                        <span class="c1">&nbsp;error message (if error)</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
               </td>
            </tr>
            <tr class="c14">
               <td class="c12 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_mavjv4fxdbf-0 start">
                     <li class="c3">
                        <span class="c9">q: </span>
                        <span class="c1">search query</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">String, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Should support spaces</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-0">
                     <li class="c3">
                        <span class="c9">username: </span>
                        <span class="c1">username</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">String, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Filter by username</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-0">
                     <li class="c3">
                        <span class="c9">following: </span>
                        <span class="c1">only show items made by users that logged in user follows</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">Boolean, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: true</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c14">
               <td class="c5" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_mavjv4fxdbf-0">
                     <li class="c3">
                        <span class="c9">rank: </span>
                        <span class="c1">Order returned items by &ldquo;time&rdquo; or by &ldquo;interest&rdquo; (weighting time vs number
                        of likes and retweets)</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">String, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: interest</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-0">
                     <li class="c3">
                        <span class="c9">parent:</span>
                        <span class="c1">&nbsp;Return items made in reply to requested item ID</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">Item ID, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: none</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-0">
                     <li class="c3">
                        <span class="c9">replies</span>
                        <span class="c1">: Include reply items</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">Boolean - if false, items that are replies should be excluded, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: true</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-0">
                     <li class="c3">
                        <span class="c9">hasMedia</span>
                        <span class="c1">: Return items with media only</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_mavjv4fxdbf-1 start">
                     <li class="c6">
                        <span class="c1">Boolean - if true, exclude all items that do not have an associated media, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c23">Default: false</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c17 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/user/&lt;username&gt;</span>
                  </p>
               </td>
               <td class="c2 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">GET</span>
                  </p>
               </td>
               <td class="c12 c16" colspan="1" rowspan="1">
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
               </td>
               <td class="c19 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_yi10tlee3ozf-0 start">
                     <li class="c3">
                        <span class="c1">Gets user profile information for &lt;username&gt;</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_yi10tlee3ozf-0">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yi10tlee3ozf-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c13 c9">user: {</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yi10tlee3ozf-2 start">
                     <li class="c10">
                        <span class="c13 c9">email:</span>
                     </li>
                     <li class="c10">
                        <span class="c9">followers: </span>
                        <span class="c1">follower count</span>
                     </li>
                     <li class="c10">
                        <span class="c9">following: </span>
                        <span class="c23">following count</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_yi10tlee3ozf-1">
                     <li class="c6">
                        <span class="c9">}</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c17 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/user/&lt;username&gt;/followers</span>
                  </p>
               </td>
               <td class="c2 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">GET</span>
                  </p>
               </td>
               <td class="c12 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_qce8ib1gjan5-0 start">
                     <li class="c3">
                        <span class="c9">limit: </span>
                        <span class="c1">number of usernames to return</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_qce8ib1gjan5-1 start">
                     <li class="c6">
                        <span class="c1">Integer, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: 50</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Max: 200</span>
                     </li>
                  </ul>
               </td>
               <td class="c19 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_les4jt6ozrvj-0 start">
                     <li class="c3">
                        <span class="c1">Gets list of users following &lt;username&gt;</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_1mxcu7j4strx-0 start">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_1mxcu7j4strx-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">users: </span>
                        <span class="c1">list of usernames (strings)</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c17 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/user/&lt;username&gt;/following</span>
                  </p>
               </td>
               <td class="c2 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">GET</span>
                  </p>
               </td>
               <td class="c12 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_qce8ib1gjan5-0">
                     <li class="c3">
                        <span class="c9">limit: </span>
                        <span class="c1">number of usernames to return</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_qce8ib1gjan5-1 start">
                     <li class="c6">
                        <span class="c1">Integer, optional</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: 50</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Max: 200</span>
                     </li>
                  </ul>
               </td>
               <td class="c19 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_les4jt6ozrvj-0">
                     <li class="c3">
                        <span class="c1">Gets list of users who &lt;username&gt; is following</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_1mxcu7j4strx-0">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_1mxcu7j4strx-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">users: </span>
                        <span class="c1">list of usernames (strings)</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c17 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/follow</span>
                  </p>
               </td>
               <td class="c2 c16" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c12 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_5jq1xt6jlwaz-0 start">
                     <li class="c3">
                        <span class="c9">username: </span>
                        <span class="c1">username to follow</span>
                     </li>
                     <li class="c3">
                        <span class="c13 c9">follow: </span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_5jq1xt6jlwaz-1 start">
                     <li class="c6">
                        <span class="c1">Boolean</span>
                     </li>
                     <li class="c6">
                        <span class="c1">Default: true</span>
                     </li>
                  </ul>
               </td>
               <td class="c19 c16" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_o77sllmnvps7-0 start">
                     <li class="c3">
                        <span class="c1">Follow or unfollow a user</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_xzs42qfuouih-0">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_xzs42qfuouih-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c0" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/item/&lt;id&gt;/like</span>
                  </p>
               </td>
               <td class="c2 c26" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c5" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_5jq1xt6jlwaz-0">
                     <li class="c3">
                        <span class="c13 c9">like:</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_5jq1xt6jlwaz-1 start">
                     <li class="c6">
                        <span class="c1">Boolean</span>
                     </li>
                     <li class="c6">
                        <span class="c23">Default: true</span>
                     </li>
                  </ul>
               </td>
               <td class="c19 c26" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_o77sllmnvps7-0">
                     <li class="c3">
                        <span class="c1">Likes or unlikes the &lt;id&gt; item</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_xzs42qfuouih-0">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_xzs42qfuouih-1 start">
                     <li class="c6">
                        <span class="c9">status</span>
                        <span class="c1">: &ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c0" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/addmedia</span>
                  </p>
               </td>
               <td class="c2 c26" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">POST</span>
                  </p>
               </td>
               <td class="c5" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">Type is multipart/form-data</span>
                  </p>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_kgebzfp2xhma-0 start">
                     <li class="c3">
                        <span class="c9">content:</span>
                        <span class="c1">&nbsp;binary content of file being uploaded</span>
                     </li>
                  </ul>
               </td>
               <td class="c19 c26" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_9z84icn7e0qf-0 start">
                     <li class="c3">
                        <span class="c1">Adds a media file (photo or video)</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_5r6xb32zhaa1-0 start">
                     <li class="c3">
                        <span class="c1">Returns</span>
                     </li>
                  </ul>
                  <ul class="c4 lst-kix_5r6xb32zhaa1-1 start">
                     <li class="c6">
                        <span class="c9">status:</span>
                        <span class="c1">&nbsp;&ldquo;OK&rdquo; or &ldquo;error&rdquo;</span>
                     </li>
                     <li class="c6">
                        <span class="c9">id:</span>
                        <span class="c1">&nbsp;ID of uploaded media</span>
                     </li>
                     <li class="c6">
                        <span class="c9">error: </span>
                        <span class="c1">error message (if error)</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_5r6xb32zhaa1-0">
                     <li class="c3">
                        <span class="c23">Remove media if it is not associated to any item in a given time</span>
                     </li>
                  </ul>
               </td>
            </tr>
            <tr class="c8">
               <td class="c0" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">/media/&lt;id&gt;</span>
                  </p>
               </td>
               <td class="c2 c26" colspan="1" rowspan="1">
                  <p class="c15">
                     <span class="c1">GET</span>
                  </p>
               </td>
               <td class="c5" colspan="1" rowspan="1">
                  <p class="c7 c33">
                     <span class="c13 c9"></span>
                  </p>
               </td>
               <td class="c19 c26" colspan="1" rowspan="1">
                  <ul class="c4 lst-kix_n34rnx3bh5tu-0 start">
                     <li class="c3">
                        <span class="c1">Gets media file by &lt;id&gt;</span>
                     </li>
                  </ul>
                  <p class="c7">
                     <span class="c1"></span>
                  </p>
                  <ul class="c4 lst-kix_c9g85xkjkv1-0 start">
                     <li class="c3">
                        <span class="c1">Returns media file (image or video)</span>
                     </li>
                  </ul>
               </td>
            </tr>
         </tbody>
      </table>
      <p class="c18">
         <span class="c1"></span>
      </p>
      <p class="c18">
         <span class="c1"></span>
      </p>
   </body>
</html>