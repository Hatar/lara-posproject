<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients =['amine','yassine','omar'];

        foreach ($clients as $client) {
            \App\Client::create([
                'name' =>$client,
                'phone' =>'011111112',
                'address'=>'Lala Meryem'
            ]);
        }
    }
}
