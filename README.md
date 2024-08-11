<h1>CarSearch</h1>
<h2>About</h2>
<span>Module dedicated to Magento 2 which allow to create and then search cars elements by car brand and car  model.</span>
<br />
<br />
<h2>How to install?</h2>
<ul>
  <li>Enter your root folder of Magento 2 project</li>
  <li><code>cd app/code</code></li>
  <li><code>mkdir Mlipski</code></li>
  <li><code>cd Mlipski</code></li>
  <li><code>git clone https://github.com/mlipski92/carsearch.git .</code></li>
  <li><code>cd ../../..</code></li>
  <li><code>php -dmemory_limit=1G bin/magento se:up</code></li>
  <li><code>php -dmemory_limit=1G bin/magento se:di:c</code></li>
  <li><code>php -dmemory_limit=1G bin/magento se:s:d -f</code></li>
  <li><code>bin/magento c:f</code></li>
</ul>
<br />
<h2>How to use it?</h2>
<ul>
  <li>After install a new attribute should apper - "mlipski_cars_skoda". It is an example attribute which should also appear on frontend (homepage)</li>
</ul>
