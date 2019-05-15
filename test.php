<?php
class TestClass
{
        public function testFile()
        {
          $response = $this->call('GET', '/');
          $this->assertRegexp('/Data Transaksi/', $response->getContent());
        }
}

?>
