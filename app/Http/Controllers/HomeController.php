<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        // dd('sdsa');
        return view('custom');
    }

    public function show()
    {
        $student = DB::table('students')->get();
        dd($student);
        return $student;
    }

    public function create()
    {
        $student = DB::table('students')
            ->insert([
                'name' => 'Tajmeel Hussain',
                'age' => 25,
                'number' => '916325698545'
            ]);

        return $student;
    }

    public function update()
    {
        $student = DB::table('students')
            ->where('id', 1)
            ->update([
                'name' => 'Tajmeel Hussain',
                'age' => 25,
                'number' => '916325698545'
            ]);

        return $student;
    }

    public function delete()
    {
        $student = DB::table('students')
            ->where('id', 1)
            ->delete();

        return $student;
    }

    public function list()
    {
        $student = DB::table('students')
            ->join('users', 'students.std_id', 'users.id')
            ->get();
    }

    public function list1()
    {
        $student = DB::table('students')
            ->leftJoin('users', 'students.std_id', 'users.id')
            ->select('students.*', 'users.name')
            ->get();
    }

    public function list2()
    {
        $student = DB::table('students')
            ->rightJoin('users', 'students.std_id', 'users.id')
            ->select('students.*', 'users.name')
            ->get();
    }

    public function multipleCondition()
    {
        $student = DB::table('students')
            ->join('users', function ($join) {
                $join->on('students.std_id', 'users.id')
                    ->where('users.status', 'active');
            })
            ->select('students.*', 'users.name')
            ->get();
    }

    public function comment()
    {
        return view('comment');
    }

    function containsBadWords($string){
        $badWords = [
            // English bad words
            'ass', 'asshole', 'bastard', 'bitch', 'bloody', 'bollocks', 'bullshit', 'crap', 
            'cunt', 'damn', 'dick', 'douche', 'dumbass', 'fag', 'faggot', 'fuck', 'fucked', 
            'fucker', 'fucking', 'goddamn', 'hell', 'jerk', 'moron', 'nigger', 'piss', 'prick', 
            'pussy', 'shit', 'shitty', 'slut', 'twat', 'whore', 'wanker', 'idiot', 'imbecile',
            'gay', 'retard', 'retarded', 'idiot', 'dumb', 'stupid', 'fool', 'nazi', 'bimbo', 
            'cum', 'dyke', 'chink', 'spic', 'wetback', 'spaz', 'homo', 'tranny', 'shemale', 'pedo', 'fatass', 
            'negro', 'negroid', 'midget', 'freak', 'pervert', 'pig', 'sicko', 'crackhead', 'junkie', 'psycho',
        
            // Hindi bad words
            'gandu', 'chutiya', 'madarchod', 'bhosdike', 'bhenchod', 'lodu', 'launda', 'haraami', 'randi', 
            'kutti', 'kutte', 'chinal', 'chudai', 'gaand', 'lavde', 'chut', 'chutmarike', 'teri maa ki', 
            'behen ke lode', 'raand', 'bhadwe', 'jhaant', 'saala', 'kamine', 'chut ke baal', 'teri maa ka', 
            'ullu ka pattha', 'chutiye', 'laude', 'chootia', 'chakka', 'haaramkhor', 'chodna', 'ma ki aankh', 
            'maa chuda', 'maaderchod', 'tera baap', 'launde',
        
            // Hindi slang (context-dependent)
            'kutta', 'kuttiya', 'kameena', 'kameeni', 'ullu', 'pagal', 'jhantu', 'saali', 'bhooki', 'bhangi',
            'chor', 'nalayak', 'bewakoof', 'nalayak', 'nalayak', 'bakwaas', 'fattu', 'tharki', 'tharki',
        
            // Variations and intentional misspellings (common tactics to bypass filters)
            'fck', 'fk', 'f u c k', 'f*ck', 'b*tch', 'sl*t', 'sh1t', 'a$$hole', 'd1ck', 'd!ck', 'n1gga', 
            'n*gga', 'cu*t', 'p*ssy', 'sh!t', 'biatch', 'c*nt', 'd@mn', 'fu(k', 'f*king', 'fuking', 
            'm@darchod', 'bh3nchod', 'rand1', 'kutt@', 'bh0sdike'
        ];
        

        foreach($badWords as $word){
            if(stripos($string, $word) !== false){
                return true;
            }
        }

        return false;
    }

    public function commentPost(Request $request)
    {
      
        $data = $request->comment;

        if ($this->containsBadWords($data)) {
            return redirect()->back()->with('error', 'Your comment contains inappropriate(Profanity) language.')->withInput();
        }
        
        $comment = new Comments;
        $comment->comment = $data;
        // dd($comment);
        $comment->save();
        

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }


}
