<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
     $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $first_names = array(
            'Mekki',
            'Sarah',
            'Allison',
            'Arthur',
            'Ana',
            'Alex',
            'Arlene',
            'Alberto',
            'Barry',
            'Bertha',
            'Bill',
            'Bonnie',
            'Bret',
            'Beryl',
            'Chantal',
            'Cristobal',
            'Claudette',
            'Charley',
            'Cindy',
            'Chris',
            'Dean',
            'Dolly',
            'Danny',
            'Danielle',
            'Dennis',
            'Debby',
            'Erin',
            'Edouard',
            'Erika',
            'Earl',
            'Emily',
            'Ernesto',
            'Felix',
            'Fay',
            'Fabian',
            'Frances',
            'Franklin',
            'Florence',
            'Gabielle',
            'Gustav',
            'Grace',
            'Gaston',
            'Gert',
            'Gordon',
            'Humberto',
            'Hanna',
            'Henri',
            'Hermine',
            'Harvey',
            'Helene',
            'Iris',
            'Isidore',
            'Isabel',
            'Ivan',
            'Irene',
            'Isaac',
            'Jerry',
            'Josephine',
            'Juan',
            'Jeanne',
            'Jose',
            'Joyce',
            'Karen',
            'Kyle',
            'Kate',
            'Karl',
            'Katrina',
            'Kirk',
            'Lorenzo',
            'Lili',
            'Larry',
            'Lisa',
            'Lee',
            'Leslie',
            'Michelle',
            'Marco',
            'Mindy',
            'Maria',
            'Michael',
            'Noel',
            'Nana',
            'Nicholas',
            'Nicole',
            'Nate',
            'Nadine',
            'Olga',
            'Omar',
            'Odette',
            'Otto',
            'Ophelia',
            'Oscar',
            'Pablo',
            'Paloma',
            'Peter',
            'Paula',
            'Philippe',
            'Patty',
            'Rebekah',
            'Rene',
            'Rose',
            'Richard',
            'Rita',
            'Rafael',
            'Sebastien',
            'Sally',
            'Sam',
            'Shary',
            'Stan',
            'Sandy',
            'Tanya',
            'Teddy',
            'Teresa',
            'Tomas',
            'Tammy',
            'Tony',
            'Van',
            'Vicky',
            'Victor',
            'Virginie',
            'Vince',
            'Valerie',
            'Wendy',
            'Wilfred',
            'Wanda',
            'Walter',
            'Wilma',
            'William',
            'Kumiko',
            'Aki',
            'Miharu',
            'Chiaki',
            'Michiyo',
            'Itoe',
            'Nanaho',
            'Reina',
            'Emi',
            'Yumi',
            'Ayumi',
            'Kaori',
            'Sayuri',
            'Rie',
            'Miyuki',
            'Hitomi',
            'Naoko',
            'Miwa',
            'Etsuko',
            'Akane',
            'Kazuko',
            'Miyako',
            'Youko',
            'Sachiko',
            'Mieko',
            'Toshie',
            'Junko');
        $number = 0;

        foreach ($first_names as $first_name) {
            $user = new User();
            // Set firs_tname
            $user->setFirstName($first_name);
            // Set last_name
            $last_name=ucfirst(strrev(strtolower($first_name)));
            $user->setLastName($last_name);
            // Set email
            $user->setEmail(strtolower($first_name).'@gmail.com');
            // Set roles
            unset($roles);
            if ($number % 2 == 0) {
                $roles[] = 'ROLE_DOCTOR';
                $role='ROLE_DOCTOR';
                $speciality= mt_rand(1,86);
            }
            else {
                $roles[] = 'ROLE_PATIENT';
                $role='ROLE_PATIENT';
                $speciality= NULL;
            }
            $user->setRoles($roles);
            // Set password
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                '12345'
            ));
            // Set birth_date
            $user->setBirthDate(new \DateTime());
            // Set phone number
            $int= mt_rand(11111111,99999999);
            $user->setPhoneNumber($int);
            // Set speciality
            $user->setSpeciality($speciality);
            // Set role
            $user->setRole($role);
            // Set profile_picture
            $user->setProfilePicture('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');
            // Set gender
            $user->setGender('GENDER');
            $manager->persist($user);
            $number++;
        }
        $manager->flush();

    }

}
