<?php

class CountContollerTest extends TestCase
{

    public function provide_index()
    {
        $input = [
            'event'     => 'ad.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input, 5]
        ];
    }


    /**
     * @dataProvider provide_index
     */
    public function test_index($input, $count)
    {
        $this->truncateStorage($input['event']);
        
        $this->generate($input, time(), $count);

        $this->json('get', 'api/report/count', ['event' => 'ad.start'])
             ->seeJson([
                 'total' => $count,
             ]);
    }


    /**
     * Validation error
     */
    public function test_index_validation_error()
    {
        $this->get('api/report/count')
            ->seeJsonStructure([
                'Error'
            ]);
    }

}