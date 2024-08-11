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
  <li>After install a new attribute should appear - "mlipski_cars_skoda". It is an example attribute which should also appear on frontend (homepage)</li>
  <li>Attributes with prefix "mlipski_cars_" are recognized as car brand attributes</li>
  <li>To add attribute you should go to backend and then <code>Stores > Attributes > Product</code></li>
  <li>Click on right top corner "Add new attribute"</li>
  <li>Enter your "Default Label" (for example Volvo) and Attribute Code set to "mlipski_cars_YOUR-CAR" (for example "mlipski_cars_volvo"). Very important: type of this field should be set as "Dropdown"</li>
  <li>Add some dropdown fields</li>
  <li>Clear Cache</li>
</ul>
