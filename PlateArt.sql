PGDMP          
            |            PlateArt    16.1    16.1 ;    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    25178    PlateArt    DATABASE     }   CREATE DATABASE "PlateArt" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "PlateArt";
                postgres    false            �            1259    25179    admin    TABLE     �   CREATE TABLE public.admin (
    email character varying(255) NOT NULL,
    password character varying(255),
    signature character varying(255)
);
    DROP TABLE public.admin;
       public         heap    postgres    false            �           0    0    TABLE admin    ACL     0   REVOKE ALL ON TABLE public.admin FROM postgres;
          public          postgres    false    215            �            1259    25184    category    TABLE     p   CREATE TABLE public.category (
    code integer NOT NULL,
    name character varying(50),
    active boolean
);
    DROP TABLE public.category;
       public         heap    postgres    false            �           0    0    TABLE category    ACL     3   REVOKE ALL ON TABLE public.category FROM postgres;
          public          postgres    false    216            �            1259    25187    category_code_seq    SEQUENCE     �   CREATE SEQUENCE public.category_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.category_code_seq;
       public          postgres    false    216            �           0    0    category_code_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.category_code_seq OWNED BY public.category.code;
          public          postgres    false    217            �            1259    25188    client    TABLE       CREATE TABLE public.client (
    email character varying(255) NOT NULL,
    telephone character varying(15),
    name character varying(50),
    surname character varying(50),
    password character varying(255),
    address character varying(255),
    dni character varying
);
    DROP TABLE public.client;
       public         heap    postgres    false            �           0    0    TABLE client    ACL     1   REVOKE ALL ON TABLE public.client FROM postgres;
          public          postgres    false    218            �            1259    25193    company    TABLE     �   CREATE TABLE public.company (
    id integer NOT NULL,
    name character varying(50),
    cif character varying(50),
    address character varying(100)
);
    DROP TABLE public.company;
       public         heap    postgres    false            �            1259    25196    company_id_seq    SEQUENCE     �   CREATE SEQUENCE public.company_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.company_id_seq;
       public          postgres    false    219            �           0    0    company_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.company_id_seq OWNED BY public.company.id;
          public          postgres    false    220            �            1259    25197    product    TABLE     -  CREATE TABLE public.product (
    code character varying(255) NOT NULL,
    name character varying(100),
    description character varying(255),
    category integer NOT NULL,
    photo character varying(255),
    price numeric(10,2),
    stock integer,
    active boolean,
    outstanding boolean
);
    DROP TABLE public.product;
       public         heap    postgres    false            �           0    0    TABLE product    ACL     2   REVOKE ALL ON TABLE public.product FROM postgres;
          public          postgres    false    221            �            1259    25202    product_category_seq    SEQUENCE     �   CREATE SEQUENCE public.product_category_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.product_category_seq;
       public          postgres    false    221            �           0    0    product_category_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.product_category_seq OWNED BY public.product.category;
          public          postgres    false    222            �            1259    25203    shopping    TABLE     �  CREATE TABLE public.shopping (
    id_shopping integer NOT NULL,
    client character varying(255),
    shopping_date date DEFAULT CURRENT_DATE,
    status character varying(20),
    total_price numeric(10,2),
    CONSTRAINT shopping_status_check CHECK (((status)::text = ANY (ARRAY[('pending'::character varying)::text, ('sent'::character varying)::text, ('cart'::character varying)::text])))
);
    DROP TABLE public.shopping;
       public         heap    postgres    false            �           0    0    TABLE shopping    ACL     3   REVOKE ALL ON TABLE public.shopping FROM postgres;
          public          postgres    false    223            �            1259    25208    shopping_details    TABLE     �   CREATE TABLE public.shopping_details (
    id integer NOT NULL,
    shopping integer NOT NULL,
    product character varying(255),
    price_per_product numeric(10,2),
    amount integer,
    total_price numeric(10,2)
);
 $   DROP TABLE public.shopping_details;
       public         heap    postgres    false            �           0    0    TABLE shopping_details    ACL     ;   REVOKE ALL ON TABLE public.shopping_details FROM postgres;
          public          postgres    false    224            �            1259    25211    shopping_details_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.shopping_details_id_seq;
       public          postgres    false    224            �           0    0    shopping_details_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.shopping_details_id_seq OWNED BY public.shopping_details.id;
          public          postgres    false    225            �            1259    25212    shopping_details_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.shopping_details_shopping_seq;
       public          postgres    false    224            �           0    0    shopping_details_shopping_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.shopping_details_shopping_seq OWNED BY public.shopping_details.shopping;
          public          postgres    false    226            �            1259    25213    shopping_id_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_id_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.shopping_id_shopping_seq;
       public          postgres    false    223            �           0    0    shopping_id_shopping_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.shopping_id_shopping_seq OWNED BY public.shopping.id_shopping;
          public          postgres    false    227            7           2604    25214    category code    DEFAULT     n   ALTER TABLE ONLY public.category ALTER COLUMN code SET DEFAULT nextval('public.category_code_seq'::regclass);
 <   ALTER TABLE public.category ALTER COLUMN code DROP DEFAULT;
       public          postgres    false    217    216            8           2604    25215 
   company id    DEFAULT     h   ALTER TABLE ONLY public.company ALTER COLUMN id SET DEFAULT nextval('public.company_id_seq'::regclass);
 9   ALTER TABLE public.company ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219            9           2604    25216    product category    DEFAULT     t   ALTER TABLE ONLY public.product ALTER COLUMN category SET DEFAULT nextval('public.product_category_seq'::regclass);
 ?   ALTER TABLE public.product ALTER COLUMN category DROP DEFAULT;
       public          postgres    false    222    221            :           2604    25217    shopping id_shopping    DEFAULT     |   ALTER TABLE ONLY public.shopping ALTER COLUMN id_shopping SET DEFAULT nextval('public.shopping_id_shopping_seq'::regclass);
 C   ALTER TABLE public.shopping ALTER COLUMN id_shopping DROP DEFAULT;
       public          postgres    false    227    223            <           2604    25218    shopping_details id    DEFAULT     z   ALTER TABLE ONLY public.shopping_details ALTER COLUMN id SET DEFAULT nextval('public.shopping_details_id_seq'::regclass);
 B   ALTER TABLE public.shopping_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224            =           2604    25219    shopping_details shopping    DEFAULT     �   ALTER TABLE ONLY public.shopping_details ALTER COLUMN shopping SET DEFAULT nextval('public.shopping_details_shopping_seq'::regclass);
 H   ALTER TABLE public.shopping_details ALTER COLUMN shopping DROP DEFAULT;
       public          postgres    false    226    224            �          0    25179    admin 
   TABLE DATA           ;   COPY public.admin (email, password, signature) FROM stdin;
    public          postgres    false    215   �A       �          0    25184    category 
   TABLE DATA           6   COPY public.category (code, name, active) FROM stdin;
    public          postgres    false    216   �A       �          0    25188    client 
   TABLE DATA           Y   COPY public.client (email, telephone, name, surname, password, address, dni) FROM stdin;
    public          postgres    false    218   PB       �          0    25193    company 
   TABLE DATA           9   COPY public.company (id, name, cif, address) FROM stdin;
    public          postgres    false    219   2C       �          0    25197    product 
   TABLE DATA           n   COPY public.product (code, name, description, category, photo, price, stock, active, outstanding) FROM stdin;
    public          postgres    false    221   �C       �          0    25203    shopping 
   TABLE DATA           [   COPY public.shopping (id_shopping, client, shopping_date, status, total_price) FROM stdin;
    public          postgres    false    223   �M       �          0    25208    shopping_details 
   TABLE DATA           i   COPY public.shopping_details (id, shopping, product, price_per_product, amount, total_price) FROM stdin;
    public          postgres    false    224   N       �           0    0    category_code_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.category_code_seq', 5, true);
          public          postgres    false    217                        0    0    company_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.company_id_seq', 1, true);
          public          postgres    false    220                       0    0    product_category_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.product_category_seq', 1, false);
          public          postgres    false    222                       0    0    shopping_details_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.shopping_details_id_seq', 4, true);
          public          postgres    false    225                       0    0    shopping_details_shopping_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.shopping_details_shopping_seq', 1, false);
          public          postgres    false    226                       0    0    shopping_id_shopping_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.shopping_id_shopping_seq', 2, true);
          public          postgres    false    227            @           2606    25221    admin admin_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (email);
 :   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_pkey;
       public            postgres    false    215            B           2606    25223    category category_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (code);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    216            D           2606    25225    client client_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.client DROP CONSTRAINT client_pkey;
       public            postgres    false    218            F           2606    25227    company company_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.company DROP CONSTRAINT company_pkey;
       public            postgres    false    219            H           2606    25229    product product_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (code);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    221            L           2606    25231 &   shopping_details shopping_details_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_pkey;
       public            postgres    false    224            J           2606    25233    shopping shopping_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_pkey PRIMARY KEY (id_shopping);
 @   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_pkey;
       public            postgres    false    223            M           2606    25234    product product_category_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_category_fkey FOREIGN KEY (category) REFERENCES public.category(code);
 G   ALTER TABLE ONLY public.product DROP CONSTRAINT product_category_fkey;
       public          postgres    false    216    221    4674            N           2606    25239    shopping shopping_client_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_client_fkey FOREIGN KEY (client) REFERENCES public.client(email);
 G   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_client_fkey;
       public          postgres    false    218    4676    223            O           2606    25244 .   shopping_details shopping_details_product_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_product_fkey FOREIGN KEY (product) REFERENCES public.product(code);
 X   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_product_fkey;
       public          postgres    false    224    4680    221            P           2606    25249 /   shopping_details shopping_details_shopping_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_shopping_fkey FOREIGN KEY (shopping) REFERENCES public.shopping(id_shopping);
 Y   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_shopping_fkey;
       public          postgres    false    224    4682    223            �      x�KL����L�1~\1z\\\ E��      �   C   x�3�t���M�)�,�2�tK�+I,���9�s3�ҁLN�ļ�D5��T ߔ�7�,3�#F��� ���      �   �   x�Mͻn�0 �����Ĺ�ylEZ
UQPC���B��&@��m����|j���2q���@��J^Pb���1�����pT�0���%hƛ.��KE�}1E���g�P��u��H)	� @�!���{�?ta繌	��
	q�2ak��}��7}+�nW�̑o'�(m_5�yJ����d�h���Uq���n�N��'w9g����lSJ���G�      �   H   x�3��I,Iu,*Qp�/*�/J,���+��06621647�L�WHIU�IT��KMI�Q�+��S06����� ��H      �   
  x��Y�v�8]3_��l�t��CK�?2q�'����"!1I� �l���V�)��ΙM"���n���ӧY|c�cR���J��2kʧVd~i�%���]�Dm���F��z��Ս-���)�h9��D��*k�&��o���ǟ�.��>�V��STG��dɣ/��ɲ���nk2&K��E��LHae�S�l���PJ���X<)t��kW�k5���ys�1p,��:��w�G��$t,���]�J��eЩ^���"/Y�˗)d��X�� �4~̢�L��L'O�^��o�QI]��謪�r���p2 �T�\S�"k�M��\4�,� �Lg�6���ʼDkJ����& ��g�qk^Dn��<@-��J�@e��e�1M-�^ٖ�v���ii��g��0��ښ|�L��SL�`���؞�N�_�AXr)~ �2ED��6�x�ƛ�2t�{��,;�:�S�x(哂�~6��w�U e�o�ip�D6N	]�Ǳ�m��;�o�@��Q�C�V��NY���<+��K[�$
�*.�J�
8�<Gz�/�t����)�+��*/#vz��OC%Ȑ���'k�����\�����
��s5�$��E��4�Cu%Ҷ�0{�DN.������6��;��y|%�+�
l�D�5.�08+U����v���K��ȼ�W
�M�N�{w=�Z٭��\c��5[x��F�`d.��h>�]ė�X���xT����;��n�(:Mo�U�v����(,1����ސ(�Z��h��hkF��m�r$ߐ0�Z�W�I��lR���溦p�o�˥���f�ya,�}iw��
��I`�9��.=���I�����J-HqM9�X�jbJ�X�pU�{h�(�KM�H��kKA(��`�Ld�q��[O�#���l ��w&��65��c,Ѣ/��:F۹5�t�
pi����)�om����!��O vߖѭgu%>�=����'{b9Zΰ��8Gr<(F�5���4	�Q�l�Ժ���P�p�m>Y4��׸w�y�y?�ީ7��MqeeA�rᷔ��qq��q��I�L�&�{�ܝT�v�Sx��O�b��
���8�1�kf��e���O��48�}S:?��w"rg�:O�R�o�bkMY�����`>B�ޠ�m��θxTs��}�p��*7�SI���z����©������|�=`�꼷��V�l���K����i�KYQ�s�7��W����:��@g�9� ���Vm��H2i�^`+�X�l`e�e��G�#vP������l�yŚ���̾"��.�oi��5�>q5�;=%��%l�d	'k;��������)�TU:�P�G�GެXc�i�sq6$w�'�8OI��{���)������9�˪���4��P�@.���O�z�K?>=?�z����.���q��j��e��Q&}Ǯ��1����O4����|�^�=���Tp#9LM]�&��&J�J+<t�yFk�E4ʐGy�?����*�6ѵyj����, x�.���{����Y4bG���ٔ�m)d��r��9Q�h�͊�-�ށ�&��`����<�k�o�v�F_��4����C%���V?��B��	�����K)CJA���³�A��'���X�4ҳ�U ;`�<�4�d��OlT�փ�o�G?	�����:1��c>'�'P?���IP�iWȩS��S�L^va�y����E��<�A�O�8d;�Xp	��S�����[|
����Y�7�'�kl�dGD��S�va~�c{�#'�Q`�´K2����v���ð~$�G��odt�jjŽ�I|)񯟤�Nc�|zcv(�ڍ ���S;'��ؘ|�ܱ=�0��BN�FJ`p�ҋ�T�R���wޯ>��Aj�v���f���C �AZz!0��4�*��$�*�<G ��gB���Λ�]��_���/�.�z�%�ey��ڠ��S�	�h�웚�v����6V:���çǍ݊d:L��K��%E�����:��0�L��@y�������w:��4aJ���k���m��D��)T+_v��f�O��'�_^c�jX�W�C�����s��^A���F|��!Sֈa�	Pdڋf�����<�_�FW�W�㰪�m�P~R�k[7(g���	��C�>�Z�U.�)	OFF>Y��a_���&e���|����ڙ6��Dr:�����������iT׬����5�<HG�e�S���{
L��#��ю�)˴��*�lK��WPڶ�d�]y��̍�*J�~lM,���Z�z��[��	t�_+u2w4��H9.�5
�|W�L5c�z"6�z/�OCh��p�lw>\�L��e��ܳ���Tb嶎~��M�M ƪ9���g�l*.Cm3�/��E|o�{�
�+��<l0x��aѯ�u����9������`��Ca���䮡<��{���{A���<\(N�&�(�{�
�
�����\�P��e����	��L�O��H��8�$�wN/h�É����/L�0�r�.�\@t�<�$�n�V��/Vڌ�]�F�rᖢ�Y�����=����R�>|�n �      �   L   x�3�LtH�M���K���4202�50�5��LN,*�4г4�2�,HL��Ǣ�Ȑ� 5/%3/����L�Ҍ+F��� �&�      �   X   x�%˫�0DQ=�/m�Q++�Ca1���/YZu'9��fK����ٍ:I�ݡ��b�d�Zg��:�|�*��+��: �h��LD�	�     