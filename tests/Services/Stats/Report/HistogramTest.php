<?php

class HistogramTest extends TestCase
{

    public function provideGet()
    {
        $data  = [
            'event'     => 'audio.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$data, 5, 1, 6, '1h']
        ];
    }

    /**
     * @dataProvider provideGet
     * @return void
     */
    public function testGet($input, $iterations, $countStart, $countStop, $interval)
    {
        $this->truncateStorage($input['event']);

        for ($i = 0; $i < $iterations; $i++) 
        { 
            $count = rand($countStart, $countStop);
            $time = strtotime("$i hours ago");

            $this->generate($input, $time, $count);

            $result[$time] = empty($result[$time]) ? $count : $result[$time] + $count;
        }
        
        $report = new \Stats\Report\Histogram;
        $histogram = $report->get($input['event'], $interval);

        $response = [];

        foreach ($result as $k => $v) 
        {
            $date = new \DateTime;
            $date->setTimestamp($k);
            $date->setTime($date->format('G'), 0);
            
            $response[$date->getTimestamp()] = $v;
        }

        foreach ($histogram as $value) 
        {
            $this->assertEquals($value['doc_count'], $response[(int)$value['key_as_string']]);
        }

    }

}