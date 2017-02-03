<?php

class EventTest extends TestCase
{
    public function provide_prepare_event()
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
     * @dataProvider provide_prepare_event
     */
    public function test_prepare_event($input)
    {
        $e = new \Stats\Event($input);

        $res = $e->prepare();

        $this->assertArrayHasKey('session', $res);
        $this->assertEquals($input['event'], $res['event']);
        $this->assertEquals($input['domain'], $res['domain']);
        $this->assertEquals($input['url'], $res['url']);
    }


    public function provide_prepare_session_event()
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
     * @dataProvider provide_prepare_session_event
     */
    public function test_prepare_session_event($input)
    {
        $e = new \Stats\Event($input);

        $res = $e->prepare();

        $this->assertEquals($input['event'], $res['event']);
        $this->assertEquals($input['domain'], $res['domain']);
        $this->assertEquals($input['url'], $res['url']);
        $this->assertEquals($input['session'], $res['session']);
    }

}