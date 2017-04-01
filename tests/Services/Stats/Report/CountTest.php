<?php

class CountTest extends TestCase
{

    public function provideGet()
    {
        $data  = [
            'event'     => 'audio.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$data, 7]
        ];
    }

    /**
     * @dataProvider provideGet
     * @return void
     */
    public function testGet($input, $count)
    {
        $this->truncateStorage($input['event']);
        
        $this->generate($input, time(), $count);

        $report = new \Stats\Report\Count;

        $total = $report->get($input['event']);
        
        $this->assertEquals($count, $total);

    }


    public function provideGetInterval()
    {
        $data  = [
            'event'     => 'audio.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$data, 7, 4, 2, 3]
        ];
    }

    /**
     * @dataProvider provideGetInterval
     * @return void
     */
    public function testGetInterval($input, $count, $fromDaysAgo, $toDaysAgo, $generateForDay)
    {
        $this->truncateStorage($input['event']);
        
        $from = strtotime("$fromDaysAgo days ago");
        $to = strtotime("$toDaysAgo days ago");
        
        // Generate events out of the provided interval
        $this->generate($input, time(), $count);

        $time = strtotime("$generateForDay days ago");

        // Generate events for the provided interval
        $this->generate($input, $time, $count);

        $report = new \Stats\Report\Count;
        $report->from($from);
        $report->to($to);

        $total = $report->get($input['event']);
        
        $this->assertEquals($count, $total);

    }


    public function provideGetFiltered()
    {
        $data  = [
            [
                'uid'       => 1,
                'event'     => 'audio.play',
                'domain'    => 'agently.io',
                'url'       => 'agently.io/apps/insta',
            ],
            [
                'uid'       => 2,
                'event'     => 'audio.play',
                'domain'    => 'agently.io',
                'url'       => 'agently.io/apps/insta',
            ],
            [
                'uid'       => 3,
                'event'     => 'audio.play',
                'domain'    => 'agently.io',
                'url'       => 'agently.io/apps/insta',
            ]

        ];

        return [
            [
                'audio.play',
                $data, 
                5,
                3
            ]
        ];
    }

    /**
     * Test get total number of events filtered by the uid parameter
     * @dataProvider provideGetFiltered
     * @return void
     */
    public function testGetFiltered($filterEvent, $data, $count, $iterations)
    {
        $this->truncateStorage($filterEvent);
        
        for ($i = 0; $i < $iterations; $i++) 
        { 
            $ev = array_rand($data);
            $input = $data[$ev];

            // Generate random events
            $this->generate($input, time(), $count);

            $result[$input['uid']] = empty($result[$input['uid']]) ? $count : $result[$input['uid']] + $count;
        }

        $report = new \Stats\Report\Count;

        foreach ($result as $uid => $r) 
        {
            $report->filter(['uid' => $uid]);
            $total = $report->get($filterEvent);

            $this->assertEquals($r, $total);
        }

    }

}