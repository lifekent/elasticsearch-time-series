<?php

class EventTest extends TestCase
{
    public function providePrepareEvent()
    {
        $input = [
            'event'     => 'ad.skip',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input]
        ];
    }


    /**
     * @dataProvider providePrepareEvent
     */
    public function testPrepareEvent($input)
    {
        $e = new \Stats\Event($input);

        $res = $e->prepare();

        $this->assertArrayHasKey('session', $res);
        $this->assertEquals($input['event'], $res['event']);
        $this->assertEquals($input['domain'], $res['domain']);
        $this->assertEquals($input['url'], $res['url']);
    }


    public function providePrepareSessionEvent()
    {
        $input = [
            'event'     => 'ad.skip',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
            'session'   => '5890267f8447f',
        ];

        return [
            [$input]
        ];
    }


    /**
     * Event with a session
     * @dataProvider providePrepareSessionEvent
     */
    public function testPrepareSessionEvent($input)
    {
        $e = new \Stats\Event($input);

        $res = $e->prepare();

        $this->assertEquals($input['event'], $res['event']);
        $this->assertEquals($input['domain'], $res['domain']);
        $this->assertEquals($input['url'], $res['url']);
        $this->assertEquals($input['session'], $res['session']);
    }

}