PGDMP      (                |            PlateArt    16.1    16.1 ;    %           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            &           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            '           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            (           1262    16740    PlateArt    DATABASE     }   CREATE DATABASE "PlateArt" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "PlateArt";
                postgres    false            �            1259    16741    admin    TABLE     �   CREATE TABLE public.admin (
    email character varying(255) NOT NULL,
    password character varying(255),
    signature character varying(255)
);
    DROP TABLE public.admin;
       public         heap    postgres    false            )           0    0    TABLE admin    ACL     0   REVOKE ALL ON TABLE public.admin FROM postgres;
          public          postgres    false    215            �            1259    16746    category    TABLE     p   CREATE TABLE public.category (
    code integer NOT NULL,
    name character varying(50),
    active boolean
);
    DROP TABLE public.category;
       public         heap    postgres    false            *           0    0    TABLE category    ACL     3   REVOKE ALL ON TABLE public.category FROM postgres;
          public          postgres    false    216            �            1259    16749    category_code_seq    SEQUENCE     �   CREATE SEQUENCE public.category_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.category_code_seq;
       public          postgres    false    216            +           0    0    category_code_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.category_code_seq OWNED BY public.category.code;
          public          postgres    false    217            �            1259    16750    client    TABLE       CREATE TABLE public.client (
    email character varying(255) NOT NULL,
    telephone character varying(15),
    name character varying(50),
    surname character varying(50),
    password character varying(255),
    address character varying(255),
    dni character varying
);
    DROP TABLE public.client;
       public         heap    postgres    false            ,           0    0    TABLE client    ACL     1   REVOKE ALL ON TABLE public.client FROM postgres;
          public          postgres    false    218            �            1259    16810    company    TABLE     �   CREATE TABLE public.company (
    id integer NOT NULL,
    name character varying(50),
    cif character varying(50),
    address character varying(100)
);
    DROP TABLE public.company;
       public         heap    postgres    false            �            1259    16809    company_id_seq    SEQUENCE     �   CREATE SEQUENCE public.company_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.company_id_seq;
       public          postgres    false    227            -           0    0    company_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.company_id_seq OWNED BY public.company.id;
          public          postgres    false    226            �            1259    16755    product    TABLE     -  CREATE TABLE public.product (
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
       public         heap    postgres    false            .           0    0    TABLE product    ACL     2   REVOKE ALL ON TABLE public.product FROM postgres;
          public          postgres    false    219            �            1259    16760    product_category_seq    SEQUENCE     �   CREATE SEQUENCE public.product_category_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.product_category_seq;
       public          postgres    false    219            /           0    0    product_category_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.product_category_seq OWNED BY public.product.category;
          public          postgres    false    220            �            1259    16761    shopping    TABLE     �  CREATE TABLE public.shopping (
    id_shopping integer NOT NULL,
    client character varying(255),
    shopping_date date DEFAULT CURRENT_DATE,
    status character varying(20),
    total_price numeric(10,2),
    CONSTRAINT shopping_status_check CHECK (((status)::text = ANY (ARRAY[('pending'::character varying)::text, ('sent'::character varying)::text, ('cart'::character varying)::text])))
);
    DROP TABLE public.shopping;
       public         heap    postgres    false            0           0    0    TABLE shopping    ACL     3   REVOKE ALL ON TABLE public.shopping FROM postgres;
          public          postgres    false    221            �            1259    16766    shopping_details    TABLE     �   CREATE TABLE public.shopping_details (
    id integer NOT NULL,
    shopping integer NOT NULL,
    product character varying(255),
    price_per_product numeric(10,2),
    amount integer,
    total_price numeric(10,2)
);
 $   DROP TABLE public.shopping_details;
       public         heap    postgres    false            1           0    0    TABLE shopping_details    ACL     ;   REVOKE ALL ON TABLE public.shopping_details FROM postgres;
          public          postgres    false    222            �            1259    16769    shopping_details_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.shopping_details_id_seq;
       public          postgres    false    222            2           0    0    shopping_details_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.shopping_details_id_seq OWNED BY public.shopping_details.id;
          public          postgres    false    223            �            1259    16770    shopping_details_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.shopping_details_shopping_seq;
       public          postgres    false    222            3           0    0    shopping_details_shopping_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.shopping_details_shopping_seq OWNED BY public.shopping_details.shopping;
          public          postgres    false    224            �            1259    16771    shopping_id_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_id_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.shopping_id_shopping_seq;
       public          postgres    false    221            4           0    0    shopping_id_shopping_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.shopping_id_shopping_seq OWNED BY public.shopping.id_shopping;
          public          postgres    false    225            m           2604    16772    category code    DEFAULT     n   ALTER TABLE ONLY public.category ALTER COLUMN code SET DEFAULT nextval('public.category_code_seq'::regclass);
 <   ALTER TABLE public.category ALTER COLUMN code DROP DEFAULT;
       public          postgres    false    217    216            s           2604    16813 
   company id    DEFAULT     h   ALTER TABLE ONLY public.company ALTER COLUMN id SET DEFAULT nextval('public.company_id_seq'::regclass);
 9   ALTER TABLE public.company ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226    227            n           2604    16773    product category    DEFAULT     t   ALTER TABLE ONLY public.product ALTER COLUMN category SET DEFAULT nextval('public.product_category_seq'::regclass);
 ?   ALTER TABLE public.product ALTER COLUMN category DROP DEFAULT;
       public          postgres    false    220    219            o           2604    16774    shopping id_shopping    DEFAULT     |   ALTER TABLE ONLY public.shopping ALTER COLUMN id_shopping SET DEFAULT nextval('public.shopping_id_shopping_seq'::regclass);
 C   ALTER TABLE public.shopping ALTER COLUMN id_shopping DROP DEFAULT;
       public          postgres    false    225    221            q           2604    16775    shopping_details id    DEFAULT     z   ALTER TABLE ONLY public.shopping_details ALTER COLUMN id SET DEFAULT nextval('public.shopping_details_id_seq'::regclass);
 B   ALTER TABLE public.shopping_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            r           2604    16776    shopping_details shopping    DEFAULT     �   ALTER TABLE ONLY public.shopping_details ALTER COLUMN shopping SET DEFAULT nextval('public.shopping_details_shopping_seq'::regclass);
 H   ALTER TABLE public.shopping_details ALTER COLUMN shopping DROP DEFAULT;
       public          postgres    false    224    222                      0    16741    admin 
   TABLE DATA           ;   COPY public.admin (email, password, signature) FROM stdin;
    public          postgres    false    215   �A                 0    16746    category 
   TABLE DATA           6   COPY public.category (code, name, active) FROM stdin;
    public          postgres    false    216   B                 0    16750    client 
   TABLE DATA           Y   COPY public.client (email, telephone, name, surname, password, address, dni) FROM stdin;
    public          postgres    false    218   YB       "          0    16810    company 
   TABLE DATA           9   COPY public.company (id, name, cif, address) FROM stdin;
    public          postgres    false    227   �B                 0    16755    product 
   TABLE DATA           n   COPY public.product (code, name, description, category, photo, price, stock, active, outstanding) FROM stdin;
    public          postgres    false    219    C                 0    16761    shopping 
   TABLE DATA           [   COPY public.shopping (id_shopping, client, shopping_date, status, total_price) FROM stdin;
    public          postgres    false    221    M                 0    16766    shopping_details 
   TABLE DATA           i   COPY public.shopping_details (id, shopping, product, price_per_product, amount, total_price) FROM stdin;
    public          postgres    false    222   aM       5           0    0    category_code_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.category_code_seq', 5, true);
          public          postgres    false    217            6           0    0    company_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.company_id_seq', 1, false);
          public          postgres    false    226            7           0    0    product_category_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.product_category_seq', 1, false);
          public          postgres    false    220            8           0    0    shopping_details_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.shopping_details_id_seq', 1, true);
          public          postgres    false    223            9           0    0    shopping_details_shopping_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.shopping_details_shopping_seq', 1, false);
          public          postgres    false    224            :           0    0    shopping_id_shopping_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.shopping_id_shopping_seq', 1, true);
          public          postgres    false    225            v           2606    16778    admin admin_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (email);
 :   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_pkey;
       public            postgres    false    215            x           2606    16780    category category_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (code);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    216            z           2606    16782    client client_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.client DROP CONSTRAINT client_pkey;
       public            postgres    false    218            �           2606    16815    company company_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.company DROP CONSTRAINT company_pkey;
       public            postgres    false    227            |           2606    16784    product product_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (code);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    219            �           2606    16786 &   shopping_details shopping_details_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_pkey;
       public            postgres    false    222            ~           2606    16788    shopping shopping_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_pkey PRIMARY KEY (id_shopping);
 @   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_pkey;
       public            postgres    false    221            �           2606    16789    product product_category_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_category_fkey FOREIGN KEY (category) REFERENCES public.category(code);
 G   ALTER TABLE ONLY public.product DROP CONSTRAINT product_category_fkey;
       public          postgres    false    219    4728    216            �           2606    16794    shopping shopping_client_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_client_fkey FOREIGN KEY (client) REFERENCES public.client(email);
 G   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_client_fkey;
       public          postgres    false    218    221    4730            �           2606    16799 .   shopping_details shopping_details_product_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_product_fkey FOREIGN KEY (product) REFERENCES public.product(code);
 X   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_product_fkey;
       public          postgres    false    222    219    4732            �           2606    16804 /   shopping_details shopping_details_shopping_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_shopping_fkey FOREIGN KEY (shopping) REFERENCES public.shopping(id_shopping);
 Y   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_shopping_fkey;
       public          postgres    false    222    221    4734                  x�KL����L�1~\1z\\\ E��         C   x�3�t���M�)�,�2�tK�+I,���9�s3�ҁLN�ļ�D5��T ߔ�7�,3�#F��� ���         z   x�KtH�M���K���435725�02�L�I��LNMI���T1�T14P���
K�pq�)	0+/qL+(����Hv�,/pI�N5)Ir�v7
�//,��.�LLL�4�022256������ �R"+      "      x������ � �         
  x��X�r�8=�_��\D�k�r,���c��&���*�"	@�D}}�Lp�����m�,�C./_b]|�4�n���6щ����i]<52K,I��Κb'++}�6���4[���]!��u����v�����&u\��֭��?˝�]|���O���f=(���)�ֽxL��ҷkd�K�+i`���o�&�S�hO�6�V�V��E�%_2�SE%/U%n+:��â|6U*�t��ii�r�T���˭ux��P������A�©�c6�z}7�٥�w�U&�w�k]�'�$_�7�/U�)&Ng�e
Y8��c��XE�)ܭ�ej�'yo���F���>:�K��.*E% ��Ғk�D�u��4�IeS����l�t�����W�E�)��l� l����Ef�>.��b��TTj
^V[WR�khm���6�z6YC8�����k'����&`qq۳Ω��7K����A%�hܺ{�U�y^L:�<�v�����O#�4Y"
��᨟u���==JĠH|�M1V���T��lz[����)dk�����шG��.�*�Ϛ�xXچ%��Ds�ږ���9�[Qq���A���lu���;���d���e�LCxB\B�])�Q��
�1?t��M�d\v��X�F�vo�����6����6�ѕW��0���}Ja�V�u	�#�r�3��+)VY�g/5�����w�zV�v[����1�G7���佑	�j�� w]�`����Q�����"�>`�����*n��qEA�),��u=u�!Q.�	����.��9�YF�N<R���oH`��y���"��(�[���(��[�r����$�Y�>���4;]�qM�$0�P��.]E?��ac�S0}�R\S��N'��2�>$\��'�R�y%���Pr��BD�3X:���2���F(`�7�� O�;+��Mm���X��h1�	L�m�ړt�Hpi����	������!��)O�,�-�m`u-?g
=����#{b9ZN���8Gr<(F�3����1�Q�luԺ��P�rg\6Y4�&�xp�Y��<z �So�k#�ʩ����o(ߵ��1�~��3��T�9swVRM��O�E�>A���G(>v�l��d\3���<��[�x���@SEt�cbf�dOƹ׊�	�,��Y2�k&�ߕ�]�'�`k���!�
�Ǆ8r.�l��j��:^n�-�qm�X{E}2%"sޠ�l���1�zT�y���/ef��C> ���d�S$7[�9�ThCV��E�|q�x����lq�Jr1'"y����������
��䖣�+2N��;�C�Lz1l����[���4+��i�r>��FY�d[l(��k�d��v��BW}��y����!(���b��RR���>�V� ���,�-�eR��t*�� �ҟ����쿋���R\ц[���n�H���� �[����Ĝ��i�B�҂c'p�:��ӑ|�c�=Ĺ��hߡT��T7�%��d�J�7��-I�\�e���?����S�!�Sq�oj�n������*�#�^�*�Һ
���ޜh
�Y� ������3�奄�a����T�Sb�F�O�3x;$�(C��y��zǔ}mŵ}��g&<�C͓��}P�QD���F�ā�)_�B�Ȓ��D{s���З%��z���%�5�׳��S������_�un�=FRJ����yz�0y�>.���
��*���
������'�2�����$0��`�\\ZJ�:�'6*t��/�cʃ��iM+��n�YIw�O��]�%X��(݌���)f�)B&/[���$�bD�A�`h�<�1���r���v\B���4�Р%V��kQ/3�.N{|�n޾��qzD���&QM��9�C8r��)��85z�j�jw
鼿�8���t�(q�jj佭H�|)�w�;��`�|zcw(�ʏ ���S['�&��l�ܱ=�0��BN�F�ep�2H�ĨBɯ$�ޯ>��Ajwv���f���C ���ep�*���Wґ%m�,Y�P����e[���I�ȸͩ|K	]Y^��6h��h�6���f��}����)��{���Q�[� �>�%�m�"��U킼�g�I� w<-қ��Έ;�^��mϠ���-��Q:Ot	���j����{~��>����:+k�#P)J��)G(���Aԯxl�G�FR��6� E��hav���%�5__\݊�۫�qX�K����0�썫j���q�ݛa����L1���j��22��E?�,�k%��k�ݭ��AS��ڙ6�5F��j�3�����������hb<�����E��2��l����L�#��ю�)˴{�E߲C���ֱS�J��Cכ�$[2��N�^�S��le�Z,��G�V��'�[Ed5�!l����
��<O��MC�.F� �,��{(L�ߴ��t��s�ޝ���-����M$4�2�(��
x��@W.S(.�˦ �f��\���dtG����6�9q���5<5<h�_�ȋ~��T\�9%����Ç�m��         1   x�3�LtH�M���K���4202�50�5��LN,*�4г4����� �	�         (   x�3�4�t�300�u��44ҳ��4�4г4����� c��     